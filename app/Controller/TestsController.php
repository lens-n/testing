<?php
App::uses('AppController', 'Controller');


/**
 * StudentsController
 *
 * @property Student $Student

 *
 */
class TestsController extends AppController{
    public $helpers = array('Html', 'Form');
    public $uses = array('Group','Faculty', 'Cours', 'Test', 'Subject', 'Teacher', 'Theme', 'Question', 'Student', 'Report' ,'ReportQuestion');
    public $components = array(
        'RequestHandler'
    );


    public function beforeFilter() {
        parent::beforeFilter();
        $this->check();
    }

    public function index(){



        $groups = $this->Group->find('all');
        $group = array();
        foreach($groups  as $item){
            $group[$item['Group']['id']] =  $item['Group'];
        }
        $this->set('groups', $group);

        $faculties = $this->Faculty->find('all');
        $faculty = array();
        foreach($faculties  as $item){
            $faculty[$item['Faculty']['id']] =  $item['Faculty'];
        }
        $this->set('faculties', $faculty);

        $teachers = $this->Teacher->find('all');
        $teacher = array();
        foreach($teachers  as $item){
            $teacher[$item['Teacher']['id']] =  $item['Teacher'];
        }
        $this->set('teachers', $teacher);

        $subjects = $this->Subject->find('all');
        $subject = array();
        foreach($subjects  as $item){
            $subject[$item['Subject']['id']] =  $item['Subject'];
        }
        $this->set('subjects', $subject);


        $courses = $this->Cours->find('all');
        $cours = array();
        foreach($courses  as $item){
            $cours[$item['Cours']['id']] =  $item['Cours'];
        }
        $this->set('courses', $cours);
        $this->set('tests', $this->Test->find('all'));
        $this->set('title_for_layout', 'Список тестов');
    }

    public function add(){
        if($this->request->data){
            $this->request->data['Test']['themes'] = json_encode($this->request->data['Test']['_serialize']);
            $this->request->data['Test']['config'] = json_encode($this->request->data['Test']['config']);
            $this->Test->saveAll($this->request->data);
            //$this->setFlash('Факультет сохранен', 'success');
            $this->redirect('/tests');
        }
        $this->set('faculties', $this->Faculty->find('all'));
        $this->set('courses', $this->Cours->find('all'));
        $this->set('subjects', $this->Subject->find('all'));
        $this->set('teachers', $this->Teacher->find('all'));

    }

    public function edit($id){
        if($this->request->data){
            $this->request->data['Test']['themes'] = json_encode($this->request->data['Test']['_serialize']);
            $this->request->data['Test']['config'] = json_encode($this->request->data['Test']['config']);

            if($this->Test->saveAll($this->request->data))
                $this->redirect('/tests');
            else
                $this->redirect($this->referer());

        }

        $data = $this->Test->read('', $id);
        $data['Test']['config'] = json_decode($data['Test']['config'],true);
        $this->set('faculties', $this->Faculty->find('all'));
        $this->set('courses', $this->Cours->find('all'));
        $this->set('subjects', $this->Subject->find('all'));
        $this->set('teachers', $this->Teacher->find('all'));
        $this->request->data = $data;
        $this->set('title', 'Редактирование предмета');
        $this->render('add');

    }

    public function del($id){
        $this->Test->delete($id);
        $this->redirect('/tests');

    }

    public function getstudent(){
        $this->layout = 'front-end';
        $this->set('students', $this->Student->find('all'));
        $this->set('tests', $this->Test->find('all',array(
            'conditions' =>  array('Test.active' =>  '1' ))));
    }

    public function start($id, $student_id){


        $this->layout = 'test';
        $test = $this->Test->read('', $id);
        $test = $test['Test'];
        $config = json_decode($test['config'],true);

        if(!empty($config['min_ip']) && !empty($config['max_ip']) ){

            $ip = $this->request->clientIp();
            $min_ip = explode('.',$config['min_ip']);
            $max_ip = explode('.',$config['max_ip']);
            $info = explode('.', $ip);

            for ($i = 0; $i < 4; $i++) {
                if (!($info[$i] >= $min_ip[$i] && $info[$i] <= $max_ip[$i])) {
                   $this->redirect('/');
                }
            }
        }


        if((int)$test['active'] !== 0){
            if(!($this->Session->read('Report_id'))){
                $data = array('students_id' => $student_id,'tests_id' => $id);
                $this->Report->saveAll($data);
                $this->Session->write('Report_id', $this->Report->getLastInsertID());
            }

            $themes_list = json_decode($test['themes'],true);

            $questions =  $this->Question->find('all',array(
                'conditions' =>  array('Question.themes_id' =>  $themes_list/*, 'Question.priority' => '0'*/ ), 'limit' => $config['max']));
            $question =  array();
            foreach($questions as $item){
               $item['Question']['answers'] = json_decode($item['Question']['answers']);
               $question[] = $item['Question'];

            }
            $this->set('test', $test);
            $this->set('questions', $question);
            $this->set('IP', $this->request->clientIp());

        }
        else{
            $this->Session->setFlash('error');
            $this->redirect('/tests');

        }

    }

    public function stop(){
        $this->layout = 'front-end';
        if($this->Session->read('Report_id')){
            $themes =  $this->Theme->find('all');
            $theme =  array();

            foreach($themes as $item){
                $theme[$item['Theme']['id']] =  $item['Theme'];
            }

            $this->set('themes', $theme);
            $id = $this->Session->read('Report_id');
            $reports = $this->ReportQuestion->find('all',array(
                'conditions' =>  array('ReportQuestion.reports_id' =>  $id,
                    ),'order' => array('ReportQuestion.themes_id')));
            $count = count($reports);
            $mark = 0;
            $themes_mark = array();
            $themes_id = '';
            $themes_count = array();
            foreach($reports as $item){
               if($themes_id !== $item['ReportQuestion']['themes_id']) {
                   $themes_id = $item['ReportQuestion']['themes_id'];

                   $themes_mark[$themes_id] = 0;
                   $themes_count[$themes_id] = 0;
               }
               if(((int)$item['ReportQuestion']['correct']) == 1){
                   if( $item['ReportQuestion']['priority'] == 0){
                       $themes_mark[$themes_id] += (int)$item['ReportQuestion']['correct'];
                        $mark+= (int)$item['ReportQuestion']['correct'];
                   }
                    else{
                        $mark+= ((int)$item['ReportQuestion']['correct'])/2;
                        $themes_mark[$themes_id] += ((int)$item['ReportQuestion']['correct'])/2;
                    }

                }

                $themes_count[$themes_id] += 1;

            }
            if($mark !== 0){
                $mark = $mark/$count*100;
                $this->Report->read(null, $id);
                $this->Report->set('mark', $mark);
                $this->Report->save();
                $this->set('mark', $mark);


            }else{
                $this->Report->read(null, $id);
                $this->Report->set('mark', $mark);
                $this->Report->save();
                $this->set('mark', $mark);
            }
            foreach($themes_mark as $item => $val){
                $themes_marks[$item]['id'] =  $item;
                $themes_marks[$item]['mark'] =  $val/$themes_count[$item]*100;

            }
            $this->set('themes_marks', $themes_marks);
            $this->set('themes_count', $themes_count);
            $this->Session->delete('Report_id');
            $this->render('stop');


        }
        else
           $this->redirect('/tests/getstudent');
    }

    public function active($id){
        $test = $this->Test->read('', $id);
        $test = $test['Test'];

        $config = json_decode($test['config'],true);
        $themes_list = json_decode($test['themes'],true);
        $questions = array();
        if((int)$test['active'] == 0){
            foreach($themes_list as $theme){
                $quest = $this->Question->find('all',array(
                    'conditions' =>  array('Question.themes_id' =>  $theme, 'Question.priority' => '0' ), 'limit' => $config['max']));

                if(count($quest) >= ((int)$config['min'])){
                    $questions[] = $quest;
                }
                else{
                    exit('Недостаточно вопросов по теме' . $theme);
                }
            }
            $this->Test->read(null, $id);
            $this->Test->set('active', '1');
            $this->Test->save();
            exit('Тест активирован!');


        }else{
            $this->Test->read(null, $id);
            $this->Test->set('active', '0');
            $this->Test->save();
            exit('Тест деактивирован!');
        }


    }

//Ajax method
    public function getThemes($subjects_id = null){
        $output = '';
        if($subjects_id == null){
            $checked = $this->request->data['checked'];
            $subjects_id = $this->request->data['subject_id'];

        }
        else{
            $checked = array();
        }


        $themes = $this->Theme->find('all', array(
            'conditions' => array('Theme.subjects_id ' => $subjects_id ) ));

        if($themes){
            foreach($themes as $item){
                if(in_array($item['Theme']['id'],$checked)){
                    $output .=  '<input type="checkbox" checked="checked"  name="data[Test][_serialize]['. $item['Theme']['id'] . ']" value="'.$item['Theme']['id'] .'">' .$item['Theme']['title'] ;
                }else{
                     $output .=  '<input type="checkbox" name="data[Test][_serialize]['. $item['Theme']['id'] . ']" value="'.$item['Theme']['id'] .'">' .$item['Theme']['title'] ;
                }
            }
        }else
            $output =  'По данному предмету нет заполненых тем!' ;
        exit($output);

    }

    public function save_answer($id){
        if(empty($this->request->data['answer']))
            exit('Вы ничего не выбрали!');
        $correct_answer = $this->Question->findById($id,array('field' => 'answer_correct'));
        $answer = trim(mb_strtolower($this->request->data['answer']));
        $correct_answer = trim(mb_strtolower($correct_answer['Question']['answer_correct']));
        $data['ReportQuestion']['questions_id'] = $id;
        $data['ReportQuestion']['answer'] = $answer;
        $data['ReportQuestion']['priority'] = $this->request->data['priority'];
        $data['ReportQuestion']['themes_id'] = $this->request->data['themes_id'];
        $data['ReportQuestion']['reports_id'] = $this->Session->read('Report_id');

        if($answer == $correct_answer){
          $mark = 1;
            $data['ReportQuestion']['correct'] = $mark;
            $this->ReportQuestion->saveAll($data);
            exit('Ответ принят!');
        }
        else{
            $mark = 0;
            $data['ReportQuestion']['correct'] = $mark;
            $this->ReportQuestion->saveAll($data);

      /*      $theme = $this->request->data['themes_id'];
            $quest = $this->Question->find('all',array(
                'conditions' =>  array('Question.themes_id' =>  $theme, 'Question.priority' => '1' )));*/

            exit('Ответ принят!');
        }



    }

}
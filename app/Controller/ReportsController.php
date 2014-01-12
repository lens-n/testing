<?php
App::uses('AppController', 'Controller');
/**
 * StudentsController
 *
 * @property Student $Student

 *
 */
class ReportsController extends AppController{
    public $helpers = array('Html', 'Form');

    public $uses = array('Report','Faculty', 'Cours', 'Test', 'Subject', 'Teacher', 'Theme', 'Question', 'Student', 'Report' ,'ReportQuestion', 'Student');

    public function index(){


      /*  $groups = $this->Group->find('all');
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
        $this->set('teachers', $teacher);*/

        $this->set('tests', $this->Test->find('all'));

        $subjects = $this->Subject->find('all');
        $subject = array();
        foreach($subjects  as $item){
            $subject[$item['Subject']['id']] =  $item['Subject'];
        }
        $this->set('subjects', $subject);

        $Tests = $this->Test->find('all');
        $Test = array();
        foreach($Tests  as $item){
            $Test[$item['Test']['id']] =  $item['Test'];
        }
        $this->set('tests', $Test);


      $students = $this->Student->find('all');
        $student = array();
        foreach($students  as $item){
            $student[$item['Student']['id']] =  $item['Student'];
        }


        $reports = $this->Report->find('all');

        $this->set('reports', $reports);
        $this->set('students', $student);
       // $this->set('tests', $this->Test->find('all'));
        $this->set('title_for_layout', 'Список тестов');
    }
    public function add(){
        if($this->request->data){
            $this->Subject->saveAll($this->request->data);
            //$this->setFlash('Факультет сохранен', 'success');
            $this->redirect('/subjects');
        }


    }

    public function edit($id){
        if($this->request->data){

            $this->Report->saveAll($this->request->data);
            //$this->setFlash('Факультет сохранен', 'success');
            $this->redirect('/subjects');
        }

        $data = $this->Report->read('', $id);
        $this->request->data = $data;
        $this->set('title', 'Редактирование предмета');
        $this->render('add');


    }

    public function del($id){
        $this->Report->delete($id);
        $this->redirect('/reports');

    }

    public function  view($id){
        //$this->set('report', $this->Report->read('',$id));


        $themes =  $this->Theme->find('all');
        $theme =  array();

        foreach($themes as $item){
            $theme[$item['Theme']['id']] =  $item['Theme'];
        }

        $this->set('themes', $theme);
        $this->ReportQuestion->bindModel(array(
            'belongsTo' => array(
                'Question' => array(

                    'foreignKey' => 'questions_id',
                )
            )
        ));
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
        $this->set('reports', $reports);


    }
}
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
    public $uses = array('Group','Faculty', 'Cours', 'Test', 'Subject', 'Teacher', 'Theme', 'Question');

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

            if($this->Test->saveAll($this->request->data))
            //$this->setFlash('Факультет сохранен', 'success');
                $this->redirect('/tests');
            else
                $this->redirect($this->referer());

        }

        $data = $this->Test->read('', $id);
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
        $this->render('index');

    }

    public function start($id){
        $test = $this->Test->read('', $id);
        $test = $test['Test'];
        $themes_list = json_decode($test['themes'],true);

        $questions = $this->Question->find('all',array(
            'conditions' =>  array('Question.themes_id' =>  $themes_list )));
        $question =  array();
        foreach($questions as $item){
           $item['Question']['answers'] = json_decode($item['Question']['answers']);
           $question[] = $item['Question'];

        }



        $this->set('test', $test);
        $this->set('questions', $question);

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

}
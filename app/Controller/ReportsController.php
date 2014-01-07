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

            $this->Subject->saveAll($this->request->data);
            //$this->setFlash('Факультет сохранен', 'success');
            $this->redirect('/subjects');
        }

        $data = $this->Subject->read('', $id);
        $this->request->data = $data;
        $this->set('title', 'Редактирование предмета');
        $this->render('add');


    }

    public function del($id){
        $this->Subject->delete($id);
        $this->redirect('/subjects');

    }
}
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
    public $uses = array('Group','Faculty', 'Cours', 'Test', 'Subject', 'Teacher');

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

            $this->Test->saveAll($this->request->data);
            //$this->setFlash('Факультет сохранен', 'success');
            $this->redirect('/tests');
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

    public function delete(){

    }

    public function start(){

    }


}
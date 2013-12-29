<?php
App::uses('AppController', 'Controller');
/**
 * StudentsController
 *
 * @property Student $Student

 *
 */
class QuestionsController extends AppController{
    public $helpers = array('Html', 'Form');
    public $uses = array( 'Themes', 'Subject', 'Question');

    public function index(){


        $this->set('questions', $this->Question->find('all'));
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
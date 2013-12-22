<?php
App::uses('AppController', 'Controller');
/**
 * StudentsController
 *
 * @property Student $Student

 *
 */
class TeachersController extends AppController{
    public $helpers = array('Html', 'Form');
    public $uses = array('Teacher');


    public function index(){
        $this->set('teachers', $this->Teacher->find('all'));
        $this->set('title_for_layout', 'Список преподавателей');
    }

    public function add(){
        if($this->request->data){
            $this->Teacher->saveAll($this->request->data);
            //$this->setFlash('Факультет сохранен', 'success');
            $this->redirect('/teachers');
        }
    }

    public function edit($id){
        if($this->request->data){
            $this->Teacher->saveAll($this->request->data);
            //$this->setFlash('Факультет сохранен', 'success');
            $this->redirect('/teachers');
        }

        $data = $this->Teacher->read('', $id);
        $this->request->data = $data;
        $this->set('title', 'Редактирование факультета');
        $this->render('add');


    }
}
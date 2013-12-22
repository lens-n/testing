<?php
App::uses('AppController', 'Controller');
/**
 * StudentsController
 *
 * @property Student $Student

 *
 */
class FacultiesController extends AppController{
    public $helpers = array('Html', 'Form');
    public $uses = array('Faculty');
    var $scaffold;

    public function index(){
        $this->set('faculties', $this->Faculty->find('all'));
        $this->set('title_for_layout', 'Список факультетов');
    }

    public function add(){
        if($this->request->data){
            $this->Faculty->saveAll($this->request->data);
            //$this->setFlash('Факультет сохранен', 'success');
            $this->redirect('/faculties');
        }
    }

    public function edit($id){
        if($this->request->data){
            $this->Faculty->saveAll($this->request->data);
            //$this->setFlash('Факультет сохранен', 'success');
            $this->redirect('/faculties');
        }

        $data = $this->Faculty->read('', $id);
        $this->request->data = $data;
        $this->set('title', 'Редактирование факультета');
        $this->render('add');


    }
}
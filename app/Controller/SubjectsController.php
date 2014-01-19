<?php
App::uses('AppController', 'Controller');
/**
 * StudentsController
 *
 * @property Student $Student

 *
 */
class SubjectsController extends AppController{
    public $helpers = array('Html', 'Form');


    public function beforeFilter() {
        parent::beforeFilter();
        $this->check();
    }

    public function index(){
        $this->set('subjects', $this->Subject->find('all'));

        $this->set('title_for_layout', 'Список предметов:');
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
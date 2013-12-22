<?php
App::uses('AppController', 'Controller');
/**
 * StudentsController
 *
 * @property Student $Student

 *
 */
class CoursesController extends AppController{
    public $helpers = array('Html', 'Form');
    public $uses = array('Cours');

    public function index(){
        $this->set('courses', $this->Cours->find('all'));
        $this->set('title_for_layout', 'Список факультетов');
    }

    public function add(){
        if($this->request->data){
            $this->Cours->saveAll($this->request->data);
            //$this->setFlash('Факультет сохранен', 'success');
            $this->redirect('/courses');
        }
    }

    public function edit($id){
        if($this->request->data){
            $this->Cours->saveAll($this->request->data);
            //$this->setFlash('Факультет сохранен', 'success');
            $this->redirect('/courses');
        }

        $data = $this->Cours->read('', $id);
        $this->request->data = $data;
        $this->set('title', 'Редактирование курса');
        $this->render('add');


    }
}
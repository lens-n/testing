<?php
App::uses('AppController', 'Controller');
/**
 * StudentsController
 *
 * @property Student $Student

 *
 */
class GroupsController extends AppController{
    public $helpers = array('Html', 'Form');
    public $uses = array('Group','Faculty', 'Cours');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->check();
    }

    public function index(){
        $this->set('groups', $this->Group->find('all',    array(
            'order' => array('Group.cours_id' => 'asc'))));

        $faculties =  array();
        $courses =  array();
        $fac =  $this->Faculty->find('all');
        $cours =  $this->Cours->find('all');
        foreach($fac as $item){
            $faculties[$item['Faculty']['id']] =  $item['Faculty'];
        }
        foreach($cours as $item){
            $courses[$item['Cours']['id']] =  $item['Cours'];
        }
        $this->set('faculties', $faculties);
        $this->set('courses', $courses);

        $this->set('title_for_layout', 'Список групп:');
    }

    public function add(){
        if($this->request->data){
            $this->Group->saveAll($this->request->data);
            $this->redirect('/groups');
        }
        $this->set('courses', $this->Cours->find('all'));
        $this->set('faculties', $this->Faculty->find('all'));

    }

    public function edit($id){
        if($this->request->data){

            $this->Group->saveAll($this->request->data);
            //$this->setFlash('Факультет сохранен', 'success');
            $this->redirect($this->referer());
        }
        $this->set('faculties', $this->Faculty->find('all'));
        $this->set('courses', $this->Cours->find('all'));
        $data = $this->Group->read('', $id);
        $this->request->data = $data;
        $this->set('title', 'Редактирование факультета');
        $this->render('add');


    }
}
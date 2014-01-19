<?php
App::uses('AppController', 'Controller');
/**
 * StudentsController
 *
 * @property Student $Student

 *
 */
class StudentsController extends AppController{
    public $helpers = array('Html', 'Form');
    public $uses = array('Group','Faculty', 'Cours','Student');


    public function beforeFilter() {
        parent::beforeFilter();
        $this->check();
    }


    public function index(){
        $this->set('students', $this->Student->find('all'));
        $this->set('title_for_layout', 'Список студентов');
    }

    public function add(){
        if($this->request->data){
            $this->Student->saveAll($this->request->data);
            //$this->setFlash('Факультет сохранен', 'success');
            $this->redirect('/students');
        }
        //$this->set('groups', $this->Group->find('all'));
        $this->set('courses', $this->Cours->find('all'));
        $this->set('faculties', $this->Faculty->find('all'));
    }

    public function edit($id){
        if($this->request->data){
            $this->Student->saveAll($this->request->data);
            //$this->setFlash('Факультет сохранен', 'success');
            $this->redirect('/students');
        }

        $data = $this->Student->read('', $id);
        $this->request->data = $data;
        //$this->set('groups', $this->Group->find('all'));
        $this->set('courses', $this->Cours->find('all'));
        $this->set('faculties', $this->Faculty->find('all'));
        $this->set('title', 'Редактирование студента    ');
        $this->render('add');

    }

    public function getGroup($cours_id, $faculty_id, $check = null){
        $output = '';
      $groups = $this->Group->find('all', array(
          'conditions' => array('Group.cours_id ' => $cours_id, 'Group.faculties_id' => $faculty_id ) ));

      if($groups){
          foreach($groups as $group){
              if($group['Group']['id'] == $check)
                  $output .=  '<option selected  value="' .$group['Group']['id'] . '">' .$group['Group']['title'] . '</option>' ;
                  else
                    $output .=  '<option value="' .$group['Group']['id'] . '">' .$group['Group']['title'] . '</option>' ;
          }
      }else
        $output =  '<option value="">пусто</option>' ;
      exit($output);

    }

    public function del($id){
        $this->Student->delete($id);
        $this->redirect('/students');
    }

}
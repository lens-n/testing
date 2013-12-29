<?php
App::uses('AppController', 'Controller');
/**
 * StudentsController
 *
 * @property Student $Student

 *
 */
class ThemesController extends AppController{
    public $helpers = array('Html', 'Form');
    public $uses = array('Theme', 'Subject');

    public function index(){
        $this->set('themes', $this->Theme->find('all'));

        $themes = $this->Subject->find('all');
        $theme = array();

        foreach($themes  as $item){
            $theme[$item['Subject']['id']] =  $item['Subject'];
        }

        $this->set('subjects', $theme);

        $this->set('title_for_layout', 'Список тем:');
    }

    public function add(){
        if($this->request->data){
            $this->Theme->saveAll($this->request->data);
            //$this->setFlash('Факультет сохранен', 'success');
            $this->redirect('/themes');
        }
        $this->set('subjects', $this->Subject->find('all'));

    }

    public function edit($id){
        if($this->request->data){

            $this->Theme->saveAll($this->request->data);
            //$this->setFlash('Факультет сохранен', 'success');
            $this->redirect('/themes');
            //$this->redirect($this->referer());
        }
        $this->set('subjects', $this->Subject->find('all'));
        $data = $this->Theme->read('', $id);
        $this->request->data = $data;
        $this->set('title', 'Редактирование темы');
        $this->render('add');


    }
}
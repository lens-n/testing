<?php
App::uses('AppController', 'Controller');
/**
 * StudentsController
 *
 * @property Student $Student

 *
 */
class AdminController extends AppController{
    public $helpers = array('Html', 'Form');
    public $uses = array('Config');

    public function login(){
    if($this->request->data['login'] &&  $this->request->data['password']){

      $configs =   $this->Config->find('first');

        if($this->request->data['login'] == $configs['Config']['login'] &&  $this->request->data['password'] == $configs['Config']['password']){
            $this->Session->write('Login', 'True');
            $this->redirect('/tests');
        }
    }

    }

    public  function logout(){
        $this->Session->delete('Login');
        $this->redirect('/');

    }

    public function settings(){

    }
}
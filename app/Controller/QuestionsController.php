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
    public $uses = array( 'Theme', 'Subject', 'Question');


    public function beforeFilter() {
        parent::beforeFilter();
        $this->check();
    }

    public function index(){
        $questions = $this->Question->find('all',    array(
            'order' => array('Question.subjects_id')));
        $quest = array();
        foreach($questions as $item){
            $item['Question']['answers'] = json_decode($item['Question']['answers']);
            $quest[] = $item['Question'];
        }
        $subjects =  $this->Subject->find('all');
        $subject =  array();

        foreach($subjects as $item){
            $subject[$item['Subject']['id']] =  $item['Subject'];
        }

        $themes =  $this->Theme->find('all');
        $theme =  array();

        foreach($themes as $item){
            $theme[$item['Theme']['id']] =  $item['Theme'];
        }
        $this->set('subjects', $subject);
        $this->set('themes', $theme);
        $this->set('questions', $quest);
        $this->set('title_for_layout', 'Список вопросов');
    }

    public function add(){
        if($this->request->data){

            $this->request->data['Question']['answers'] = json_encode($this->request->data['Question']['_serialize']);
            $this->Question->saveAll($this->request->data);
            //$this->setFlash('Факультет сохранен', 'success');
            $this->redirect('/questions');
        }

        $this->set('subjects', $this->Subject->find('all'));


    }

    public function edit($id){
        if($this->request->data){
            $this->request->data['Question']['answers'] = json_encode($this->request->data['Question']['_serialize']);
            $this->Question->saveAll($this->request->data);
            //$this->setFlash('Факультет сохранен', 'success');
            $this->redirect('/questions');
        }

        $data = $this->Question->read('', $id);
        $data['Question']['answers'] =json_decode( $data['Question']['answers']);

        $this->set('subjects', $this->Subject->find('all'));


        $this->request->data = $data;
        $this->set('title', 'Редактирование предмета');
        $this->render('add');

    }

    public function del($id){
        $this->Question->delete($id);
        $this->redirect('/questions/');
    }


    public function getThemes($subjects_id, $themes_id = null){
        $output = '';

          $themes = $this->Theme->find('all', array(
            'conditions' => array('Theme.subjects_id ' => $subjects_id ) ));

        if($themes){
            foreach($themes as $item){
                if($item['Theme']['id'] == $themes_id){
                    $output .=  '<option selected="selected" value="'. $item['Theme']['id'] .'">'.$item['Theme']['title'] .'</option>';
                }else{
                    $output .=  '<option value="'. $item['Theme']['id'] .'">'.$item['Theme']['title'] .'</option>';
                }


            }
        }else
            $output =  'По данному предмету нет заполненых тем!' ;
        exit($output);

    }


}
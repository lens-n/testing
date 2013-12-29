<?php
App::uses('AppModel', 'Model');

/**
 * Subject Model
 *
 */

class Test extends AppModel {
    //public $useTable = 'subjects';
    /**
     * Validation rules
     * @var array
     */
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty',
            'message' => 'Имя теста не может быть пустым!'
        ),


    );
}
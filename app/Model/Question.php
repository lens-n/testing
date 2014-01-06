<?php
App::uses('AppModel', 'Model');

/**
 * Subject Model
 *
 */

class Question extends AppModel {
    //public $useTable = 'subjects';
    /**
     * Validation rules
     * @var array
     */
    public $validate = array(
        'text' => array(
            'rule' => 'notEmpty',
            'message' => 'Имя вопроса не может быть пустым!'
        ),
        'answer_correct' => array(
            'rule' => 'notEmpty',
            'message' => 'Имя вопроса не может быть пустым!'
        ),

    );
}

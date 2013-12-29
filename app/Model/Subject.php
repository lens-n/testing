<?php
App::uses('AppModel', 'Model');

/**
 * Subject Model
 *
 */

class Subject extends AppModel {
    //public $useTable = 'subjects';
    /**
     * Validation rules
     * @var array
     */
    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty',
            'message' => 'Имя факультета не может быть пустым!'
        ),

    );
}

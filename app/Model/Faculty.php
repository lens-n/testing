<?php
App::uses('AppModel', 'Model');

/**
 * Student Model
 *
 */

class Faculty extends AppModel {
    public $useTable = 'faculties';
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

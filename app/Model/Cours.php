<?php
App::uses('AppModel', 'Model');

/**
 * Student Model
 *
 */

class Cours extends AppModel {
    public $useTable = 'courses';
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

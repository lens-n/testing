<?php
App::uses('AppModel', 'Model');

/**
 * Student Model
 *
 */

class Student extends AppModel {
    //public $useTable = 'students';

    public $validate = array(
        'fname' => array(
            'rule' => 'notEmpty',
            'message' => ''
        ),
        'sname' => array(
            'rule' => 'notEmpty',
            'message' => ''
        ),
        'pname' => array(
            'rule' => 'notEmpty',
            'message' => ''
        ),

    );
}

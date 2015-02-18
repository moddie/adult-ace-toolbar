<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Tasks extends ORM
{
    protected $_table_name  = 'tasks';
    protected $_primary_key = 'id';  
    
    protected $_belongs_to = array(
        'users'  => array(
               'model'       => 'users',
               'foreign_key' => 'user_id',
        ),        
    );

    public function rules()
    {
        return array(                        
            'user_id' => array(
                array('not_empty')
            ),      
            'parent_id' => array(
                array('not_empty')
            ),
            'title' => array(
                array('not_empty')
            ),
        );  
    }
    
}
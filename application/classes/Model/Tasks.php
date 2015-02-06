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
        'task_categories'  => array(
               'model'       => 'task_categories',
               'foreign_key' => 'category_id',
        ),
    );

    public function rules()
    {
        return array(                        
            'user_id' => array(
                array('not_empty')
            ),      
            'category_id' => array(
                array('not_empty')
            ),
            'title' => array(
                array('not_empty')
            ),
        );  
    }
    
}
<?php

defined('SYSPATH') or die('No direct script access.');

class Model_TaskCategories extends ORM
{
    protected $_table_name  = 'task_categories';
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
            'pid' => array(
                array('not_empty')
            ),
            'name' => array(
                array('not_empty')
            ),
        );  
    }
    
}
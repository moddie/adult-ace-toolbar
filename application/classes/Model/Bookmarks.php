<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Bookmarks extends ORM
{
    protected $_table_name  = 'bookmarks';
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
        );
    }
    
}
<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Users extends ORM
{
    protected $_table_name  = 'users';
    protected $_primary_key = 'id';    

    public function rules()
    {
        return array(                        
            'username' => array(
                array('not_empty')
            ),            
        );
    }
    
}
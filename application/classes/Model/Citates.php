<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Citates extends ORM
{
    protected $_table_name  = 'citates';
    protected $_primary_key = 'id'; 

    public function rules()
    {
        return array(
            'text' => array(
                array('not_empty')
            ),
        );
    }
    
}
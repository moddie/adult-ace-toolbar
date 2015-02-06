<?php

defined('SYSPATH') or die('No direct script access.');

class Model_CurrentCitates extends ORM
{
    protected $_table_name  = 'current_citates';
    protected $_primary_key = 'id'; 
    
    protected $_belongs_to = array(
        'citetes'  => array(
               'model'       => 'citetes',
               'foreign_key' => 'citete_id',
        )
    );


    public function rules()
    {
        return array(                        
            'citate_id' => array(
                array('not_empty')
            ),             
        );
    }
    
}
<?php

defined('SYSPATH') or die('No direct script access.');

class Model_CurrentImages extends ORM
{
    protected $_table_name  = 'current_images';
    protected $_primary_key = 'id';
    
    protected $_belongs_to = array(
        'images'  => array(
                 'model'       => 'images',
                 'foreign_key' => 'image_id',
        )
    );
  

    public function rules()
    {
        return array(          
            'image_id' => array(
                array('not_empty')
            ),            
        );
    }
    
}
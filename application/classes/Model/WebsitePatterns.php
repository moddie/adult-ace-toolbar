<?php

defined('SYSPATH') or die('No direct script access.');

class Model_WebsitePatterns extends ORM
{
    protected $_primary_key = 'id';
    protected $_table_name = 'campaigns_website_patterns';
    protected $_belongs_to = array(
		'campaign' => array(
            'model'       => 'Campaign',
            'foreign_key' => 'id_country'
        )
	);
    public function rules()
	{
		return array(
			'pattern' => array(
				array('not_empty'), array('url'), array('max_length', array(':value', 2000)),
                /*array(function($value, Validation $object)
                    {
                        $object->error('some_field', 'some_error');
                    }, array(':value', ':validation')),*/
                ),
            'id_campaign' => array(
                array('not_empty')
                )
            );
            
        
    }
}

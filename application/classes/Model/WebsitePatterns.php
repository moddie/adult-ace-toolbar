<?php

defined('SYSPATH') or die('No direct script access.');

class Model_WebsitePatterns extends ORM
{
    protected $_table_name = 'campaigns_website_patterns';
    protected $_belongs_to = array(
		'campaign' => array(
            'model'       => 'Campaign',
            'foreign_key' => 'id_country'
        )
	);
}
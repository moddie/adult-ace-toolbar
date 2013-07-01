<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Campaigns extends ORM
{
    protected $_table_name  = 'campaigns';
    protected $_primary_key = 'id_campaign';

    protected $_belongs_to = array(
		'country' => array(
            'model'       => 'Countries',
            'foreign_key' => 'id_country'
        )
	);
    protected $_has_many = array(
        'patterns' => array(
            'model'       => 'WebsitePatterns',
            'foreign_key' => 'id_campaign'
        ),
        'ad_urls' => array(
            'model'       => 'AdUrls',
            'foreign_key' => 'id_campaign'
        )
    );
}
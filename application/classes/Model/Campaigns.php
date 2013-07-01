<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Campaigns extends ORM {

    protected $_table_name = 'campaigns';
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
    
    public function count_by_params($filter)
    {
        if ($filter)
        {
            $this->where('id_country', '=', $filter);
        }
                
        return $this->with('countries')->count_all();
    }
    
    public function delete()
    {
        foreach($this->patterns->find_all() as $entry)
        {
            $entry->delete();
        }
        foreach($this->ad_urls->find_all() as $entry)
        {
            $entry->delete();
        }
        parent::delete();
    }
    
    
    
}
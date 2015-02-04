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

    public function count_by_params($filter)
    {
        if ($filter)
        {
            $this->where('id_country', '=', $filter);
        }

        return $this->with('countries')->count_all();
    }

    public function rules()
	{
		return array(
            'name' => array(
                array('not_empty')
            ),
            'id_country' => array(
                array('not_empty'),
                array('digit'),
                array(
                    function($value, Validation $object)
                    {
                        if ($value != 0)
                        {
                            $country = ORM::factory('Countries')->find_by_id($value);
                            if (!$country->pk())
                            {
                                $object->error('id_country', 'invalid_country');
                            }
                        }
                    }, 
                    array(':value', ':validation')
                )
            ),
            'click_limit' => array(
				array('digit')
			)
		);
	}
    
    public function delete()
    {
        $patterns = $this->patterns->find_all();
        if (count($patterns) > 0)
        {
            foreach($patterns as $entry)
            {

                $entry->delete();
            }
        }
        $urls = $this->ad_urls->find_all();
        if ( count($urls) > 0)
        {
            foreach($urls as $entry)
            {
                $entry->delete();
            }
        }
        parent::delete();
        
    }
}
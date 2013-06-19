<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Ads extends ORM {

    protected $_table_name = 'ads';
    protected $_primary_key = 'id_ad';
    
    protected $_belongs_to = array(
		'countries' => array('model' => 'Countries', 'foreign_key' => 'id_country'),
	);

    public function rules()
	{
		return array(
			'website' => array(
				array('not_empty'), array('url'), array('max_length', array(':value', 2000)),
			),
            'open_url' => array(
				array('not_empty'), array('url'), array('max_length', array(':value', 2000)),
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
                ),
            ),
            'position' => array(
				array('digit'),
			),
		);
	}
    
    public function labels()
    {
       return array(
           'website' => 'Website',
           'open_url' => 'Open url',
           'id_country' => 'Country',
       );
    }
    
    public function find_by_params($website, $page, $limit = 10)
    {
        if ($website)
        {
            $this->where('website', '=', $website);
            $this->order_by('position', 'ASC');
        }
        
        if ($page < 1)
        {
            $page = 1;
        }
        
        if ($limit)
        {
            $this->limit($limit)->offset(($page-1)*$limit);
        }
        
        return $this->with('countries')->find_all();
    }
    
    public function count_by_params($website)
    {
        if ($website)
        {
            $this->where('website', '=', $website);
        }
                
        return $this->with('countries')->count_all();
    }
    
    public function get_websites()
    {
        return $this->group_by('website')->find_all();
    }
    
    public function add_new()
    {
        $this->position = 1;
        
        $position = ORM::factory('Ads')->where('website', '=', $this->website)->order_by('position', 'DESC')->find();
        if ($position->pk())
        {
            $this->position += $position->position;
        }        
        
        return $this->save();
    }
    
    public function find_by_website_pos($website, $pos, $direction)
    {
        if ($direction == 'up')
        {
            $this->where('position', '<', $pos)->order_by('position', 'DESC');
        }
        else
        {
            $this->where('position', '>', $pos)->order_by('position', 'ASC');
        }
            
        return $this->where('website', '=', $website)->find();
    }
}
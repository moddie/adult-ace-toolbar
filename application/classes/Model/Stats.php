<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Stats extends ORM {

    protected $_table_name = 'stats';
    protected $_primary_key = 'id_stat';
    
    protected $_belongs_to = array(
		'country' => array('model' => 'Countries', 'foreign_key' => 'id_country'),
	);
        
    public function find_by_params($params, $page, $limit = 10)
    {
        foreach ($params as $param => $val)
        {
            $this->where($param, '=', $val);
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
        $pos = 1;
        $position = ORM::factory('Ads')->where('website', '=', $this->website)->order_by('position', 'DESC')->find();
        if ($position->pk())
        {
            $this->position = $position->position + $pos;
        }
        
        return $this->save();
    }
    
    public function find_by_website_pos($website, $pos)
    {
        return $this->where('website', '=', $website)->where('position', '=', $pos)->find();
    }
}
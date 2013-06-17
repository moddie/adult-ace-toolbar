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
        }
        
        $this->order_by('date', 'DESC');
        $this->order_by('amount_users', 'DESC');
        
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
    
    public function count_by_params($params)
    {
        foreach ($params as $param => $val)
        {
            $this->where($param, '=', $val);
        }
                
        return $this->with('countries')->count_all();
    }
}
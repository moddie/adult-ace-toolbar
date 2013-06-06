<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Videos extends ORM {

    protected $_table_name = 'videos';
    protected $_primary_key = 'id_video';
    
    public function find_by_params($keyword = NULL, $length = NULL, $site = NULL, $page = 1, $per_page = 20)
    {
        if ($keyword)
        {
            $this->where('title', 'like', '%'.$keyword.'%');
        }
        
        if ($length)
        {
            $this->where('length', '>=', $length);
        }
        
        if ($site)
        {
            $this->where('site', '=', $site);
        }
        
        if ($per_page > 500)
        {
            $per_page = 500;
        }
        
        if ($per_page < 1)
        {
            $per_page = 1;
        }
        
        if ($page < 1)
        {
            $page = 1;
        }
        
        $this->limit($per_page)
                ->offset(($page-1)*$per_page);

        return $this->find_all();
    }
    
    public function get_sites()
    {
        return $this->group_by('site')->find_all();
    }

}
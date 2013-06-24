<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Videos extends ORM {

    protected $_table_name = 'videos';
    protected $_primary_key = 'slug';

    public function find_by_params($keyword = NULL, $length = NULL, $site = NULL, $page = 1, $per_page = 20)
    {
        if ($keyword)
        {
            $this->where('title', 'like', '%'.$keyword.'%');
        }

        if ($length)
        {
            $this->where('vid_length', '>=', $length);
        }

        if ($site)
        {
            $this->where('site_name', 'like', '%' . $site);
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

    public function count_by_params($keyword = NULL, $length = NULL, $site = NULL)
    {
        if ($keyword)
        {
            $this->where('title', 'like', '%'.$keyword.'%');
        }

        if ($length)
        {
            $this->where('vid_length', '>=', $length);
        }

        if ($site)
        {
            $this->where('site_name', 'like', '%' . $site);
        }

        return $this->count_all();
    } // end count_by_params

    public function get_sites()
    {
        return $this->group_by('site_name')->find_all();
    }

}
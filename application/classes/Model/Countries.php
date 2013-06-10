<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Countries extends ORM {

    protected $_table_name = 'countries';
    protected $_primary_key = 'id_country';
    
    public function find_by_id($id)
    {
        return $this->where('id_country', '=', $id)->find();
    }
    
}
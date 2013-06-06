<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Categories extends ORM {

    protected $_table_name = 'categories';
    protected $_primary_key = 'id_category';
    
    protected $_has_many = array(
        'details' => array('model' => 'Details', 'foreign_key' => 'id_category'),
    );
    
    public function find_all_by_mdl_subid($mdl, $subid)
    {
        $categories = $this
                ->where('mdl', '=', $mdl)
                ->where('subid', '=', $subid)
                ->find_all();
        
        return $categories;
    }

}
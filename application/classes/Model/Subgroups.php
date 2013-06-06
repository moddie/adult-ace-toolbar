<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Subgroups extends ORM {

    protected $_table_name = 'subgroups';
    protected $_primary_key = 'id_subgroup';
    
    public function find_all_by_mdl_group($mdl, $group)
    {
        $subgroups = $this
                ->where('mdl', '=', $mdl)
                ->where('groupid', '=', $group)
                ->find_all();
        
        return $subgroups;
    }

}
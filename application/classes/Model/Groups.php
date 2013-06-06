<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Groups extends ORM {

    protected $_table_name = 'groups';
    protected $_primary_key = 'id_group';

    public function find_by_firm_mdl($id_firm, $mdl)
    {
        $groups = $this
                ->where('id_firm', '=', $id_firm)
                ->where('mdl', '=', $mdl)
                ->find_all();
        
        return $groups;
    }
    
}
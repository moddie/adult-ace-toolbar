<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Firms extends ORM {

    protected $_table_name = 'firms';
    protected $_primary_key = 'id_firm';

    protected $_has_many = array(
        'models' => array('model' => 'Models', 'foreign_key' => 'id_firm'),
    );
    
    public function find_by_name($name)
    {
        $firm = $this->where('name', '=', $name)->find();
        if ($firm->pk())
        {
            return $firm;
        }
        
        return FALSE;
    }

}
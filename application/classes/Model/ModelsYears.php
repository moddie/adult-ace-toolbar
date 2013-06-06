<?php

defined('SYSPATH') or die('No direct script access.');

class Model_ModelsYears extends ORM {

    protected $_table_name = 'models_years';
    protected $_primary_key = 'id_model_year';

    protected $_has_many = array(
        'models_years' => array('model' => 'models_years', 'foreign_key' => 'id_model'),
    );
    
    public function find_by_mdl($mdl)
    {
        $model = $this->where('mdl', '=', $mdl)->find();
        if ($model->pk())
        {
            return $model;
        }
        
        return FALSE;
    }

}
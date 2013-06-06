<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Models extends ORM {

    protected $_table_name = 'models';
    protected $_primary_key = 'id_model';

    protected $_has_many = array(
        'models_years' => array('model' => 'ModelsYears', 'foreign_key' => 'id_model'),
    );

}
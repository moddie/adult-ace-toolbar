<?php

defined('SYSPATH') or die('No direct script access.');

class Model_WebsitePatterns extends ORM
{
    protected $_primary_key = 'id';
    protected $_table_name = 'campaigns_website_patterns';
    protected $_belongs_to = array(
		'campaign' => array(
            'model'       => 'Campaign',
            'foreign_key' => 'id_country'
        )
	);

    public function rules()
	{
		return array(
			'pattern' => array(
				array('not_empty'),
                array('max_length', array(':value', 2000)),
                array(array($this, 'isValidPattern'), array(':validation', ':field')),
            ),
            'id_campaign' => array(
                array('not_empty')
            )
        );
    }

    function isValidPattern(Validation $validation, $field)
    {
        if (!preg_match('~^\*?[^\*]+\*?$~si', $validation[$field]))
        {
            $validation->error($field, 'pattern_not_valid', array($validation[$field]));
        }

        $checkPatternSql = 'SELECT *
            FROM `' . $this->_table_name . '` AS `cwp`
            WHERE
                :pattern LIKE REPLACE( `cwp`.`pattern` , \'*\', \'%\' )
                OR `cwp`.`pattern` LIKE REPLACE( :pattern, \'*\', \'%\' )';

        $checkPatternQuery = DB::query(Database::SELECT, $checkPatternSql)
            ->param(':pattern', $validation[$field]);

        if ($checkPatternQuery->execute()->count() > 0)
        {
            $validation->error($field, 'crossing_pattern_exist', array($validation[$field]));
        }

        return TRUE;
    } // end isValidPattern
}

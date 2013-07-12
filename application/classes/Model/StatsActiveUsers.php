<?php

defined('SYSPATH') or die('No direct script access.');

class Model_StatsActiveUsers extends ORM {

    protected $_table_name = 'stats_active_users';
    protected $_primary_key = 'id_country';

    protected $_belongs_to = array(
		'country' => array('model' => 'Countries', 'foreign_key' => 'id_country'),
	);

    public function find_by_params($params, $page, $limit = 10)
    {
        foreach ($params as $param => $val)
        {
            $this->where($param, '=', $val);
        }

        $this
            ->select(array(DB::expr('COUNT("ip_address")'), 'amount_users'))

            ->group_by('id_country');

        if ($page < 1)
        {
            $page = 1;
        }

        if ($limit)
        {
            $this->limit($limit)->offset(($page - 1) * $limit);
        }

        return $this->with('countries')->find_all();
    }

    public function count_by_params($params)
    {
        foreach ($params as $param => $val)
        {
            $this->where($param, '=', $val);
        }

        return count($this->group_by('id_country')->find_all());
    }
}
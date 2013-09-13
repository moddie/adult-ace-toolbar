<?php

defined('SYSPATH') or die('No direct script access.');

class Model_StatsInstalls extends ORM
{
    protected $_table_name = 'stats_installs';

    protected $_belongs_to = array(
		'country' => array('model' => 'Countries', 'foreign_key' => 'id_country'),
	);

    public function findByParams($params, $page, $limit = 10, $orderBy = 'id', $orderDirection = 'ASC')
    {
        foreach ($params as $param => $val)
        {
            $this->where($param, '=', $val);
        }

        if ($page < 1)
        {
            $page = 1;
        }

        if ($limit)
        {
            $this->limit($limit)->offset(($page - 1) * $limit);
        }

        if(!in_array(strtolower($orderDirection), array('asc', 'desc')))
        {
            $orderDirection = 'asc';
        }

        switch($orderBy)
        {
            case 'chrome':
            case 'firefox':
            case 'ie':
            case 'unknown':
                $orderBy = 'amount_installs_' . $orderBy;
                break;

            case 'country':
                $countryTableName = 'countries';
                $this
                    ->join($countryTableName, 'LEFT')
                    ->using('id_country');
                $orderBy = $countryTableName . '.name_en';
                break;

            case 'total':
                $orderBy = DB::expr(
                    '(amount_installs_chrome + amount_installs_firefox + amount_installs_ie + amount_installs_unknown)'
                );
                break;

            case '':
                $orderBy = 'id';
                break;
        }

        $this->order_by($orderBy, $orderDirection);

        return $this->with('countries')->find_all();
    }

    public function countByParams($params)
    {
        foreach ($params as $param => $val)
        {
            $this->where($param, '=', $val);
        }

        return $this->with('countries')->count_all();
    }
}
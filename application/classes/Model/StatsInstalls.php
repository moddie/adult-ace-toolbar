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
        if(false && (isset($params['dateFrom']) && !empty($params['dateFrom']))
            || (isset($params['dateTo']) && !empty($params['dateTo'])))
        {
            $query = DB::select('amount_installs_chrome', 'amount_installs_firefox', 'amount_installs_ie', 'amount_installs_unknown',
                                'date',
                                array('name_en', 'countryName'),
                                array(DB::expr('(`amount_installs_chrome`+`amount_installs_firefox`+'
                                                .'`amount_installs_ie`+`amount_installs_unknown`)'),
                                               'sum_amount_total'))
                    ->from('stats_installs');
        }
        else
        {
            $query = DB::select(array('name_en', 'countryName'),
                                array(DB::expr('"-"'),'date'),
                                array(DB::expr('SUM(`amount_installs_chrome`)'), 'sum_amount_installs_chrome'),
                                array(DB::expr('SUM(`amount_installs_firefox`)'), 'sum_amount_installs_firefox'),
                                array(DB::expr('SUM(`amount_installs_ie`)'), 'sum_amount_installs_ie'),
                                array(DB::expr('SUM(`amount_installs_unknown`)'), 'sum_amount_installs_unknown'),
                                array(DB::expr('(SUM(`amount_installs_chrome`)+SUM(`amount_installs_firefox`)+'
                                                .'SUM(`amount_installs_ie`)+SUM(`amount_installs_unknown`))'),
                                               'sum_amount_total')

                                )
                ->from('stats_installs');
        }
        
        foreach ($params as $param => $val)
        {
            if(empty($val))
            {
                continue;
            }
            if($param == 'dateFrom' && !empty($val))
            {
                $query->where('date', '>=', $val);
            }
            elseif($param == 'dateTo' && !empty($val))
            {
                $query->where('date', '<=', $val);
            }
            else
            {
                $query->where($param, '=', $val);
            }
            
        }

        if ($page < 1)
        {
            $page = 1;
        }

        if ($limit)
        {
            $query->limit($limit)->offset(($page - 1) * $limit);
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
                $orderBy = (((isset($params['dateFrom']) && !empty($params['dateFrom']))
                || (isset($params['dateTo']) && !empty($params['dateTo'])))?'':'sum_').'amount_installs_' . $orderBy;
                break;

            case 'country':
                $orderBy = 'countryName';
                break;

            case 'total':
                $orderBy = 'sum_amount_total';
                break;

            case '':
                $orderBy = 'id';
                break;
        }

        $query->order_by($orderBy, $orderDirection);
        /*
        if( !((isset($params['dateFrom']) && !empty($params['dateFrom']))
            || (isset($params['dateTo']) && !empty($params['dateTo']))))
        {*/
        $query->group_by('stats_installs.id_country');
        //}
        $query->join('countries','left')->on('countries.id_country', '=', 'stats_installs.id_country');
        return $query->execute()->as_array();
    }

    public function countByParams($params)
    {
        $query = DB::select()->from('stats_installs');
        foreach ($params as $param => $val)
        {
            if(empty($val))
            {
                continue;
            }
            if($param == 'dateFrom' && !empty($val))
            {
                $query->where('date', '>=', $val);
            }
            elseif($param == 'dateTo' && !empty($val))
            {
                $query->where('date', '<=', $val);
            }
            else
            {
                $query->where($param, '=', $val);
            }
            
        }
        if( !((isset($params['dateFrom']) && !empty($params['dateFrom']))
            || (isset($params['dateTo']) && !empty($params['dateTo']))))
        {
            $query->group_by('stats_installs.id_country');
        }
        $query->join('countries','left')->on('countries.id_country', '=', 'stats_installs.id_country');
        return $query->execute()->count();
    }
}
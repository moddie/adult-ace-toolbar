<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Catalog extends Controller_Base {

    public $template = 'layouts/common';

    public function action_index()
	{
        $param_firm = Request::$current->param('firm');
        
        if ($param_firm)
        {
            $firm = ORM::factory('Firms')->find_by_name($param_firm);
            if ($firm)
            {
                $view = View::factory('scripts/catalog/firm');
                $view->firm = $firm;
                $view->models = $firm->models->find_all();
            }
        }
        else
        {
            $view = View::factory('scripts/catalog/index');
            $view->firms = ORM::factory('Firms')->find_all();
        }
        
		$this->display($view);
	}
    
    public function action_groups()
	{
        $view = View::factory('scripts/catalog/groups');

        $param_firm = Request::$current->param('firm');
        
        if (!$param_firm)
        {
            die;
        }
        $firm = ORM::factory('Firms')->find_by_name($param_firm);
        if (!$firm)
        {
            die;
        }
        $view->firm = $firm;
        
        $mdl = Arr::get($_GET, 'model');
        $model = ORM::factory('ModelsYears')->find_by_mdl($mdl);
        if (!$model->pk())
        {
            die;
        }
        
        $view->groups = ORM::factory('Groups')->find_by_firm_mdl($firm->pk(), $mdl);
        $view->model = $model;
        
		$this->display($view);
	}
    
    public function action_subgroups()
	{
        $view = View::factory('scripts/catalog/subgroups');

        $param_firm = Request::$current->param('firm');
        
        if (!$param_firm)
        {
            die;
        }
        $firm = ORM::factory('Firms')->find_by_name($param_firm);
        if (!$firm)
        {
            die;
        }
        $view->firm = $firm;
        
        $mdl = Arr::get($_GET, 'model');
        $model = ORM::factory('ModelsYears')->find_by_mdl($mdl);
        if (!$model->pk())
        {
            die;
        }
        $view->model = $model;
        
        $groupid = Arr::get($_GET, 'group');
        
        $view->subgroups = ORM::factory('Subgroups')->find_all_by_mdl_group($mdl, $groupid);
        
		$this->display($view);
	}
    
    public function action_details()
	{
        $view = View::factory('scripts/catalog/details');

        $param_firm = Request::$current->param('firm');
        
        if (!$param_firm)
        {
            die;
        }
        $firm = ORM::factory('Firms')->find_by_name($param_firm);
        if (!$firm)
        {
            die;
        }
        $view->firm = $firm;
        
        $mdl = Arr::get($_GET, 'model');
        $model = ORM::factory('ModelsYears')->find_by_mdl($mdl);
        if (!$model->pk())
        {
            die;
        }
        
        $subid = Arr::get($_GET, 'subid');
        
        $view->categories = ORM::factory('Categories')->find_all_by_mdl_subid($mdl, $subid);

        $md5 = md5($firm->pk().$mdl.$subid);
        $view->img_url = 'http://evgeniy.dev/elcats_parser/images/schemas/'.$md5[0].'/'.$md5[1].'/'.$md5.'/'.$md5.'.jpg';
        
		$this->display($view);
	}

}
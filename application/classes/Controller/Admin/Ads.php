<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Ads extends Controller_Auth {

    public $template = 'layouts/admin';

    public function action_index()
	{
        $view = View::factory('scripts/admin/ads');
        
        $view->countries = array();
        
		$this->display($view);
	}
    
}
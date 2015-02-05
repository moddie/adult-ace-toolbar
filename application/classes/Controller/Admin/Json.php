<?php defined('SYSPATH') or die('No direct script access.');

const FORM_CSV_PATERNS_FIELD_NAME = 'csv_patterns';
const FORM_CSV_ADURLS_FIELD_NAME  = 'csv_adurls';

class Controller_Admin_Json extends Controller_Auth
{
    public $template = 'layouts/json';
    
    public function action_user_block() 
    {
        $view = View::factory('scripts/admin/user_block');
        $id = Arr::get($_GET, 'id', NULL);
        $action = Arr::get($_GET, 'action', 'block'); 
        $user = ORM::factory('Users', $id);
        
        if (in_array($action, array('block','unblock'))) 
        {            
            $user->status = $action;
            $user->save();
        }
        
        $view->user = $user;        
	$this->display($view);
    }

} // end Controller_Admin_Campaigns

<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Json extends Controller_Auth
{
    public $template = 'layouts/json';
    
    public function action_user_block() 
    {
        $view = View::factory('scripts/admin/user_block');
        $error = View::factory('errors/admin/user_block');
        
        $id = Arr::get($_GET, 'id', NULL);
        $action = Arr::get($_GET, 'action', 'block'); 
        $user = ORM::factory('Users', $id);
        if ($user->loaded()) 
        {
            if ($user->status != 'not active') 
            {
                if ($action == 'block') 
                {                
                    $user->status = 'blocked';
                    $user->save();
                }
                else if ($action == 'activate')
                {                
                    $user->status = 'active';
                    $user->save();
                }        
            }
            // Display table row            
            $view->user = $user;                    
            $this->display($view);
        }
        else
        {
            // Display Errors
            $error->message = 'User with id '.$id.' not found';
            $this->display($error);
        }
    }

} // end Controller_Admin_Campaigns

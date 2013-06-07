<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller_Base {

   public function __construct($request, $response)
   {
        parent::__construct($request, $response);
       
        if( preg_match('/^admin/',Request::$current->param('directory')) && 'login' != Request::$current->param('controller') )
        {
            //Check admin autentification
            if( !Auth::instance()->logged_in('admin') )
            {
                Controller::redirect( Route::get('admin')->uri(array('controller' => 'login', 'action' => 'index')) );
            }
        }
    }

}
<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Login extends Controller_Auth {

    public $template = 'layouts/admin';

    public function action_index() {
        
        if (Auth::instance()->logged_in('admin'))
        {
            Controller::redirect( Route::get('admin')->uri(array('controller' => 'ads', 'action' => 'index')) );
        }
        
        $view = View::factory('scripts/admin/login');
        
        $post = $this->request->post();
        $success = Auth::instance()->login(Arr::get($post, 'username'), Arr::get($post, 'password'));

        if ($success)
        {
            // Login successful, send to app
            Controller::redirect( Route::get('admin')->uri(array('controller' => 'ads', 'action' => 'index')) );
        }
        else
        {
            // Login failed, send back to form with error message
            $view->error = 'Unable to login';
        }
        
		$this->display($view);
	}
    
    public function action_logout() {
        
        Auth::instance()->logout(FALSE, TRUE);
        
        Controller::redirect( Route::get('admin')->uri(array('controller' => 'login', 'action' => 'index')) );
        
    }
}
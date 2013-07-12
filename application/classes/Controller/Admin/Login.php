<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Login extends Controller_Auth {

    public $template = 'layouts/admin';

    public function action_index() {

        if (Auth::instance()->logged_in('admin'))
        {
            Controller::redirect( URL::base(TRUE) . Route::get('admin')->uri(array('controller' => 'Campaigns', 'action' => 'index')) );
        }

        $view = View::factory('scripts/admin/login');
	
	$this->template->title = 'Login page';
	
        $post = $this->request->post();
        if ($post)
        {
            $success = Auth::instance()->login(Arr::get($post, 'username'), Arr::get($post, 'password'));

            if ($success)
            {
                $redirectUrl = Session::instance()->get_once(
                    'requestedUrl',
                    Route::get('admin')->uri(array('controller' => 'Campaigns', 'action' => 'index'))
                );
                // Login successful, send to app
                Controller::redirect( $redirectUrl );
            }
            else
            {
                // Login failed, send back to form with error message
                $view->error = __('Unable to login');
            }
        }

		$this->display($view);
	}

    public function action_logout() {

        Auth::instance()->logout(FALSE, TRUE);

        Controller::redirect( URL::base(TRUE) . Route::get('admin')->uri(array('controller' => 'Login', 'action' => 'index')) );

    }
}
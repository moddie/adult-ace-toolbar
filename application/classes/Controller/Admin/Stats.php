<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Stats extends Controller_Auth {

    public $template = 'layouts/admin';

    public function action_index()
	{
        $view = View::factory('scripts/admin/stats');
        
        $view->stats = ORM::factory('Stats')->find_by_params(array('date' => $date), $page, $per_page);
        
        
        $page = intval(Arr::get($_GET, 'page', 1));
        $view->page = $page;
        $per_page = 10;
        $date = Arr::get($_GET, 'date', time());
        
        $pagination_view = new View('pagination/ads');
        $pagination_view->page = $page;
        $pagination_view->perpage = $per_page;
        $pagination_view->website = $website;
        $pagination_view->count_all = ORM::factory('Stats')->count_by_params(array('date' => $date));
        $view->pagination = $pagination_view->render();
                        
		$this->display($view);
	}
    
    public function action_delete()
	{
        $view = View::factory('scripts/admin/ads');
        
        $website = Arr::get($_GET, 'website', NULL);
        
        $ids = Arr::get($_POST, 'ids');
        if (is_array($ids))
        {
            foreach ($ids as $id) 
            {
                ORM::factory('Ads', $id)->delete();
            }
        }
        
        Session::instance()->set('delete_message', __('Deleted succesfully'));
        
        Controller::redirect( URL::base(TRUE) . Route::get('admin')->uri(array('controller' => 'ads', 'action' => 'index')) . '?filter_website=' . $website );
    }
}
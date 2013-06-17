<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Stats extends Controller_Auth {

    public $template = 'layouts/admin';

    public function action_index()
	{
        $view = View::factory('scripts/admin/stats');
        
        $params = array();
        
        $page = intval(Arr::get($_GET, 'page', 1));
        $view->page = $page;
        $per_page = 10;
        $date = Arr::get($_GET, 'date', '');
        if ($date AND ($date_object = DateTime::createFromFormat('m/d/Y', $date)))
        {
            $date = $date_object->format('m/d/Y');
            $params['date'] = $date_object->format('Y-m-d');
        }
        
        $view->date = $date;
        
        $view->stats = ORM::factory('Stats')->find_by_params($params, $page, $per_page);
        //echo ORM::factory('Stats')->last_query();
        
        $pagination_view = new View('pagination/stats');
        $pagination_view->page = $page;
        $pagination_view->perpage = $per_page;
        $pagination_view->date = $date;
        $pagination_view->count_all = ORM::factory('Stats')->count_by_params($params);
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
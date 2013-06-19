<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Ads extends Controller_Auth {

    public $template = 'layouts/admin';

    public function action_index()
	{
        $view = View::factory('scripts/admin/ads');
        $errors = array();
        $messages = array();
        
        $view->countries = ORM::factory('Countries')->find_all();
            
        $new_ad = ORM::factory('Ads');
        if (isset($_POST['website']))
        {
            $new_ad->website = trim(Arr::get($_POST, 'website'), "/ ");
            $new_ad->open_url = trim(Arr::get($_POST, 'open_url'), "/ ");
            $new_ad->id_country = Arr::get($_POST, 'id_country');
            try
            {
                $new_ad->add_new();
                $messages['add'] = __('Added successfully');
                $new_ad->clear();
            }
            catch(ORM_Validation_Exception $e)
            {
                $errors = $e->errors('', TRUE);
            }
        }
        $view->new_add = $new_ad;
                
        if (isset($_POST['limit']))
        {            
            $limit = Arr::get($_POST, 'limit');
            $int_options = array(
                "options" => array(
                    "min_range" => 0, 
                    "max_range" => 1000000,
                )
            );
            $limit = filter_input(INPUT_POST, 'limit', FILTER_VALIDATE_INT, $int_options);
            if ($limit === FALSE)
            {
                $errors['limit'] = __('Limit must be integer!'); 
            }
            else 
            {
                ORM::factory('Settings')->set_setting('limit', $limit);
                $messages['settings'] = __('Settings changed successfully');
            }
        }
        
        $view->errors = $errors;
        
        $view->settings = ORM::factory('Settings')->find_all();
        
        
        $page = intval(Arr::get($_GET, 'page', 1));
        $view->page = $page;
        $per_page = 10;
        $website = Arr::get($_GET, 'filter_website', NULL);
        $view->website = $website;
        $view->ads = ORM::factory('Ads')->find_by_params($website, $page, $per_page);
        $pagination_view = new View('pagination/ads');
        $pagination_view->page = $page;
        $pagination_view->perpage = $per_page;
        $pagination_view->website = $website;
        $pagination_view->count_all = ORM::factory('Ads')->count_by_params($website);
        $view->pagination = $pagination_view->render();
        
        $view->websites = ORM::factory('Ads')->get_websites();
        
        $delete_message = Session::instance()->get('delete_message');
        if ($delete_message)
        {
            $messages['delete'] = $delete_message;
            Session::instance()->delete('delete_message');
        }
        $view->messages = $messages;
                
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
    
    public function action_move()
	{
        $view = View::factory('scripts/admin/ads');
        
        $website = Arr::get($_GET, 'website', NULL);
        $page = intval(Arr::get($_GET, 'page', 1));
        
        $id = Arr::get($_GET, 'id', NULL);
        $direction = Arr::get($_GET, 'direction');
        
        $advertisement = ORM::factory('Ads', $id);
        
        if ($advertisement->loaded())
        {
            $pos = $advertisement->position;
            
            $change_advertisement = ORM::factory('Ads')->find_by_website_pos($website, $pos, $direction);
            if ($change_advertisement->pk())
            {
                $new_pos = $change_advertisement->position;
                
                $advertisement->position = $new_pos;
                $advertisement->save();

                $change_advertisement->position = $pos;
                $change_advertisement->save();
            }
            
        }
        
        Controller::redirect( URL::base(TRUE) . Route::get('admin')->uri(array('controller' => 'ads', 'action' => 'index')) . '?page=' . $page . '&filter_website=' . urlencode($website) );
    }
}
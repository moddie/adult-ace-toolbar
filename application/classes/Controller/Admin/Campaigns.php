<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Campaigns extends Controller_Auth {

    public $template = 'layouts/admin';

    public function action_index()
	{
        
        if (!empty($_POST['delete'])){
            $this->_delete(array_keys($_POST['delete']));
        }
        $view = View::factory('scripts/admin/campaigns');
        $page = intval(Arr::get($_GET, 'page', 1));
        $view->page = $page;
        $per_page = 10;
        $filter = intval(Arr::get($_GET, 'filter', 0));
        $campaigns = ORM::factory('Campaigns');
        if ($filter > 0)
        {
            $campaigns->where('id_country', '=', $filter);
        }
        if ($page < 1)
        {
            $page = 1;
        }
        if ($per_page)
        {
            $campaigns->limit($per_page)->offset(($page-1)*$per_page);
        }
        $pagination_view = new View('pagination/campaigns');
        $pagination_view->page = $page;
        $pagination_view->perpage = $per_page;
        $pagination_view->filter = $filter;
        $pagination_view->count_all = ORM::factory('Campaigns')->count_by_params($filter);
        $view->pagination = $pagination_view->render();
        $view->filter = $filter;
        $view->campaigns = $campaigns->with('countries')->find_all();;//ORM::factory('Campaigns')->with('countries')->find_all();
        $view->countries = ORM::factory('Countries')->find_all();        
		$this->display($view);
	}
    
    public function action_add()
    {
        
    }
    
    protected function _delete($idCampaign = null)
    {
        if (!empty($idCampaign))
        {
            $campaignsToDelete = ORM::factory('Campaigns');
            
            if ( is_array($idCampaign) )
            {
                $campaignsToDelete->where('id_campaign', 'in', $idCampaign);
            }
            else
            {
                $campaignsToDelete->where('id_campaign', '=', $idCampaign);
            }
            $campaignsToDelete->find()->delete();

            //TODO: delete related patterns and ad_urls
        }
    }
    
}
<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Stats extends Controller_Auth {

    public $template = 'layouts/admin';

    public function action_index()
	{
        $view = View::factory('scripts/admin/stats');

        $params = array();
        $params['date'] = Arr::get($_GET,'date','');

        $this->template->title = 'Statistics';

        $page = intval(Arr::get($_GET, 'page', 1));

        $order = explode('|', Arr::get($_GET, 'order', 'id'));

        $orderBy = $order[0];
        $orderDirection = (isset($order[1])) ? $order[1] : 'asc';

        $view->page           = $page;
        $view->orderBy        = $orderBy;
        $view->orderDirection = $orderDirection;
        
        $perPage = 10;

        $view->stats = ORM::factory('StatsInstalls')->findByParams($params, $page, $perPage, $orderBy, $orderDirection);

        $pagination_view = new View('pagination/stats');

        $pagination_view->page           = $page;
        $pagination_view->perPage        = $perPage;
        $pagination_view->countAll       = ORM::factory('StatsInstalls')->countByParams($params);

        $view->pagination = $pagination_view->render();

		$this->display($view);
	}

}
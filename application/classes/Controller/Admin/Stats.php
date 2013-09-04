<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Stats extends Controller_Auth {

    public $template = 'layouts/admin';

    public function action_index()
	{
        $view = View::factory('scripts/admin/stats');

        $params = array();

        $this->template->title = 'Statistics';
        $page = intval(Arr::get($_GET, 'page', 1));
        $view->page = $page;
        $per_page = 10;

        $view->stats = ORM::factory('StatsInstalls')->findByParams($params, $page, $per_page);

        $pagination_view = new View('pagination/stats');
        $pagination_view->page = $page;
        $pagination_view->perpage = $per_page;
        $pagination_view->count_all = ORM::factory('StatsInstalls')->countByParams($params);
        $view->pagination = $pagination_view->render();

		$this->display($view);
	}

}
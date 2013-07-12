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
        $date = Arr::get($_GET, 'date', '');
        if ($date AND ($date_object = DateTime::createFromFormat('m/d/Y', $date)))
        {
            $date = $date_object->format('m/d/Y');
            $params['date'] = $date_object->format('Y-m-d');
        }

        $view->date = $date;

        $view->stats = ORM::factory('StatsActiveUsers')->find_by_params($params, $page, $per_page);

        $pagination_view = new View('pagination/stats');
        $pagination_view->page = $page;
        $pagination_view->perpage = $per_page;
        $pagination_view->date = $date;
        $pagination_view->count_all = ORM::factory('StatsActiveUsers')->count_by_params($params);
        $view->pagination = $pagination_view->render();

		$this->display($view);
	}

}
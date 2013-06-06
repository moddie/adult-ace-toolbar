<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_Videos extends Controller_Base {

    public $template = 'layouts/empty';

    public function action_get()
	{
        $keyword = Arr::get($_GET, 'keyword', NULL);
        $site = Arr::get($_GET, 'site', NULL);
        $length = intval(Arr::get($_GET, 'length', 0));
        $page = intval(Arr::get($_GET, 'page', 1));
        $per_page = intval(Arr::get($_GET, 'per_page', 20));
        
        $result = array(
            'videos' => array(),
            'sites' => array(),
        );
        
        $videos = ORM::factory('Videos')->find_by_params($keyword, $length, $site, $page, $per_page);
        foreach ($videos as $video)
        {
            $result['videos'][] = array(
                'title' => $video->title,
                'site' => $video->site,
                'url' => $video->url,
                'length' => $video->length,
                'thumbnail' => $video->thumbnail,
            );
        }
        
        $sites = ORM::factory('Videos')->get_sites();
        foreach ($sites as $site)
        {
            $result['sites'][] = $site->site;
        }
        
		$this->display_ajax(json_encode($result));
	}
    
}
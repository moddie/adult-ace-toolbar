<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_Videos extends Controller_Base
{
    public $template = 'layouts/empty';

    public function action_get()
	{
        $keyword  = Arr::get($_GET, 'keyword', NULL);
        $site     = Arr::get($_GET, 'site', NULL);
        $length   = intval(Arr::get($_GET, 'length', 0));
        $page     = intval(Arr::get($_GET, 'page', 1));
        $per_page = intval(Arr::get($_GET, 'per_page', 20));

        $result = array(
            'videos' => array(),
            'sites'  => array(),
        );

        $videos = ORM::factory('Videos')->find_by_params($keyword, $length, $site, $page, $per_page);
        foreach ($videos as $video)
        {
            $thumb = '';
            if(!empty($video->images))
            {
                $thumb = json_decode($video->images, TRUE);
                if(is_array($thumb))
                {
                    $thumb = array_shift($thumb);
                }
            }

            $siteName = $video->site_name;
            if(!empty($video->site_name))
            {
                $parsedUrl = parse_url($video->site_name);
                if(isset($parsedUrl['host']))
                {
                    $siteName = $parsedUrl['host'];
                }
            }

            $result['videos'][] = array(
                'title'     => $video->title,
                'site'      => $siteName,
                'url'       => $video->link,
                'length'    => $video->vid_length,
                'thumbnail' => $thumb,
            );

        }

        $sites = ORM::factory('Videos')->get_sites();
        foreach ($sites as $site)
        {
            $siteName = $site->site_name;
            if(!empty($site->site_name))
            {
                $parsedUrl = parse_url($site->site_name);
                if(isset($parsedUrl['host']))
                {
                    $siteName = $parsedUrl['host'];
                }
            }
            $result['sites'][] = $siteName;
        }

		$this->display_ajax('getSearchResults(' . json_encode($result) . ')');
	}

}
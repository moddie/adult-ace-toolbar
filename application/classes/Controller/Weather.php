<?php defined('SYSPATH') OR die('No Direct Script Access');

Class Controller_Weather extends Controller_Base
{
    public $template = 'layouts/common';

    public function action_info()
    {
        $this->template->title = 'Weather';
        $view = View::factory('scripts/weather');
        $view->error = true;
        $ip = Request::$client_ip;
//        $ip = '77.66.230.217';
        if (!empty($ip))
        {
      
            $view->ip = $ip;
            $cityInfo = Helper_SxGeoHelper::getCityByIp($ip);
            $view->cityInfo = $cityInfo;
            if(!empty($cityInfo))
            {
                $apiUrl = 'http://api.openweathermap.org/data/2.5/weather?q=' . $cityInfo['city'] . ',' . $cityInfo['country'];
                try
                {
                    $answer = Request::factory($apiUrl)->execute()->body();
                }
                catch(Exception $e){};
                if(!empty($answer))
                {
                    $answer = json_decode($answer);
                    if(isset($answer->cod) && $answer->cod == 200)
                    {
                        $view->answer = $answer;
                        $view->error = false;
                        $t = $answer->main->temp - 273;
                    }

                }
            }
        }
        $this->display($view);
    }
}
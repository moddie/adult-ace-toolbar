<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_Geo extends Controller_Base
{
    public $template = 'layouts/empty';

    public function action_place()
    {
        require_once DOCROOT . 'vendor/SypexGeo/SxGeo.php';
        $sxGeo = new SxGeo(DOCROOT . 'vendor/SypexGeo/SxGeoCity.dat');
        //$ip = '54.251.129.117';
        $ip = REQUEST::$client_ip;
        $city = $sxGeo->getCityFull($ip);
        unset($sxGeo);
        
        $result = array('status' => 1);
        $place = false;
        if( is_array($city) )
        {
            if( isset($city['city']) && !empty($city['city']['name_en']) )
            {
                $place = $city['city']['name_en'];
            }
            elseif( isset($city['country']) && !empty($city['country']['name_en']) )
            {
                $place = $city['country']['name_en'];
            }
        }
        
        if( !$place )
        {
            $result['status'] = 0;
        }
        else 
        {
            $result['place'] = $place;
        }
        
        echo json_encode($result);
    } 

} // end Controller_Api_Stats
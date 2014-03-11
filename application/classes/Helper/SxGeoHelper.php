<?php  defined('SYSPATH') or die('No direct script access.');

require_once DOCROOT . 'vendor/SypexGeo/SxGeo.php';

class Helper_SxGeoHelper {

    public static function getCountryByIp($ip) {

        if (!$ip)
        {
            return FALSE;
        }

        $sxGeo = new SxGeo(DOCROOT . 'vendor/SypexGeo/SxGeo.dat');
        $country = $sxGeo->getCountry($ip);
        unset($sxGeo);
        return $country;

    }

    public static function getCityByIp($ip) {

        if (!$ip)
        {
            return FALSE;
        }

        $sxGeo = new SxGeo(DOCROOT . 'vendor/SypexGeo/SxGeoCity.dat');
        $city = $sxGeo->getCity($ip);
        unset($sxGeo);
        return $city;

    }

}
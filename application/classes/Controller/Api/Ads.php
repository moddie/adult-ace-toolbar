<?php defined('SYSPATH') or die('No direct script access.');

const LIMIT_PERIOD = 86400; // 24hrs

class Controller_Api_Ads extends Controller_Base
{
    public $template = 'layouts/empty';

    protected $_page       = '';
    protected $_ads        = array();
    protected $_campaignId = null;
    protected $_countryIso = '';
    protected $_countryId  = 0;
    protected $_position   = 0;

    public function action_get()
	{
        $this->_getAds();
        $this->_checkLimit();

        if(!empty($this->_ads))
        {
            die('aatAttachAds()');
        }
        die;
	} // end action_get

    public function action_goto()
	{
        if(($adUrl = $this->_getAdUrl()) !== '')
        {
            $adUrl = str_replace('<referer>', urlencode($this->request->referrer()), $adUrl);
            header('Location: ' . $adUrl);
            $this->_writeStats();
        }
        die;
	} // end action_goto

    /**
     * Wrapper for SxGeo getCountry method
     *
     * @return string Country iso code
     */
    protected function _getCountry()
    {
        require_once DOCROOT . 'vendor/SypexGeo/SxGeo.php';
        $sxGeo = new SxGeo(DOCROOT . 'vendor/SypexGeo/SxGeoCity.dat');
        
        $ip = REQUEST::$client_ip;
        //$ip = '54.251.129.117';
        
        $this->_country = $sxGeo->getCountry($ip);

        $countryModel = ORM::factory('Countries')->where('iso', '=', $this->_country)->find();
        if(!is_null($countryModel->pk()))
        {
            $this->_countryId = $countryModel->pk();
        }

        unset($sxGeo);
    } // end _getCountry

    /**
     * Get ads list from db by page url
     *
     */
    protected function _getAds()
    {
        $this->_page = $this->request->referrer();
        //$this->_page = 'http://usa.com/?asdas';
        
        $this->_getCountry();
        $queryString = parse_url($this->_page);
        $replaceParams = array(
            ':page'      => $this->_page,
            ':idCountry' => $this->_countryId
        );


        $campaignsSql = 'SELECT *
                    FROM `campaigns_website_patterns` AS `cwp`
                    LEFT JOIN `campaigns` AS `c` ON (`c`.`id_campaign` = `cwp`.`id_campaign`)
                    WHERE :page LIKE REPLACE( `cwp`.`pattern` , \'*\', \'%\' ) AND ';

        if($this->_countryId)
        {
            $campaignsSql .= '(`c`.`id_country` = 0 OR `c`.`id_country` = :idCountry)';
        }
        else
        {
            $campaignsSql .= '`c`.`id_country` = 0';
        }

        if( is_array($queryString) && !empty($queryString['query']) )
        {
            $campaignsSql .= ' AND ((`c`.`keyword` IS NOT NULL  AND `c`.`keyword` != "" AND  '.
                             ':keyword LIKE CONCAT("%", `c`.`keyword`, "%" )) OR `c`.`keyword` IS NULL OR `c`.`keyword` = "") ';
            $replaceParams[':keyword'] = $queryString['query'];
        }
        else
        {
            $campaignsSql .= ' AND ( `c`.`keyword` IS NULL OR `c`.`keyword` = "") ';
        }
        

        $campaignsSql .= ' ORDER BY `c`.`id_country` DESC';

        $campaignsQuery = DB::query(Database::SELECT, $campaignsSql)->parameters($replaceParams);

        $this->_campaignId = $campaignsQuery->execute()->get('id_campaign');
        
        $adsSql   = 'SELECT * FROM `campaigns_ad_urls` WHERE `id_campaign` = :campaignId ORDER BY `position` ASC';
        $adsQuery = DB::query(Database::SELECT, $adsSql)
            ->parameters(array(
                ':campaignId' => $this->_campaignId
            ));

        $result = $adsQuery->execute();
        
        if($result->count() > 0)
        {
            $this->_ads = $result->as_array('position');
            $this->_filterAds();
        }
    } // end _getAds

    /**
     * Filter ads by Country or All countries
     *
     */
    protected function _filterAds()
    {
        $result = $this->_ads;

        $firstAdData = reset($this->_ads);

        if(!empty($this->_ads) && (isset($firstAdData['id_country']) && intval($firstAdData['id_country']) > 0))
        {
            $result = array();
            foreach ($this->_ads as $position => $adData)
            {
                if(intval($adData['id_country']) !== 0)
                {
                    $result[$position] = $adData;
                }
            }
        }

        $this->_ads = $result;
    } // end _filterAds

    /**
     *  Get ad url from ads list
     *
     * @return string current ad url
     */
    protected function _getAdUrl()
    {
        if(empty($this->_ads))
        {
            $this->_getAds();
        }

        $lastPosition = Session::instance()->get($this->_campaignId . '_lastPosition', NULL);
        if(!is_null($lastPosition))
        {
            foreach($this->_ads as $position => $adData)
            {
                if($position > $lastPosition)
                {
                    $this->_position = $position;
                    return $adData['target_url'];
                }
            }
        }
        $currentAd = reset($this->_ads);
        $this->_position = key($this->_ads);
        return $currentAd['target_url'];
    } // end _getAdUrl

    /**
     * check the limit is exceeded.
     * If true, no ad will be returned
     *
     */
    protected function _checkLimit()
    {
        $currentTime = time();
        $session     = Session::instance();

        $clicks = $session->get($this->_campaignId . '_clicks', 0);
        if($clicks === 0)
        {
            return;
        }


        if($currentTime - $session->get($this->_campaignId . '_startAt', $currentTime) > LIMIT_PERIOD)
        {
            $session->set($this->_campaignId . '_clicks', 0);
            $session->set($this->_campaignId . '_startAt', $currentTime);
            return;
        }

        $campaign = ORM::factory('Campaigns')->where('id_campaign', '=', $this->_campaignId)->find();

        if(!is_null($campaign->click_limit) && intval($campaign->click_limit) <= $clicks)
        {
            die;
        }
    } // end _checkLimit

    /**
     * Increase clicks amount for current country and date
     *
     */
    protected function _writeStats()
    {
        $clicksSessionKey   = $this->_campaignId . '_clicks';
        $session = Session::instance();

        $clicks = $session->get($clicksSessionKey, 0);
        $clicks++;
        $session->set($clicksSessionKey, $clicks);
        $session->set($this->_campaignId . '_lastPosition', $this->_position);

        $statsActiveUsersSql = 'INSERT IGNORE INTO `stats_active_users` (`id_country`, `ip_address`)
            VALUES (:idCountry, :ipAddress)';
        DB::query(Database::INSERT, $statsActiveUsersSql)
            ->parameters(array(
                ':idCountry' => $this->_countryId,
                ':ipAddress' => REQUEST::$client_ip
            ))
            ->execute();
    } // end _writeStats
} // end Controller_Api_Ads
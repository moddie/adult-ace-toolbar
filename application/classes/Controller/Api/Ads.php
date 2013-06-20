<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_Ads extends Controller_Base
{
    public $template = 'layouts/empty';

    protected $_page       = '';
    protected $_ads        = array();
    protected $_countryIso = '';
    protected $_countryId  = 0;
    protected $_position   = 0;

    public function action_get()
	{
        $this->_checkLimit();
        $this->_getAds();
        $this->_filterAds();

        if(!empty($this->_ads))
        {
            die('aatAttachAds()');
        }
        die;
	} // end action_get

    public function action_goto()
	{
        $this->_getAds();
        $this->_filterAds();

        if(($adUrl = $this->_getAdUrl()) !== '')
        {
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
        $sxGeo = new SxGeo(DOCROOT . 'vendor/SypexGeo/SxGeo.dat');
        $this->_country = $sxGeo->getCountry(REQUEST::$client_ip);
        //$this->_country = 'RU'; //TODO: remove this line

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
        $this->_getCountry();

        $adsSql = 'SELECT * FROM `ads` WHERE :page LIKE CONCAT(\'%\', `website`, \'%\') AND ';

        if($this->_countryId)
        {
            $adsSql .= '(id_country = 0 OR `id_country` = :idCountry)';
        }
        else
        {
            $adsSql .= 'id_country = 0';
        }

        $adsSql .= ' ORDER BY `id_country` DESC, `position` ASC';

        $adsQuery = DB::query(Database::SELECT, $adsSql)
            ->parameters(
                array(
                    ':page'         => $this->_page,
                    ':idCountry'    => $this->_countryId
                )
            );

        $result = $adsQuery->execute();

        if($result->count() > 0)
        {
            $this->_ads = $result->as_array('position');
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
            return '';
        }

        $lastPosition = Session::instance()->get(sha1($this->_page), NULL);
        if(!is_null($lastPosition))
        {
            foreach($this->_ads as $position => $adData)
            {
                if($position > $lastPosition)
                {
                    $this->_position = $position;
                    return $adData['open_url'];
                }
            }
        }
        $currentAd = reset($this->_ads);
        $this->_position = key($this->_ads);
        return $currentAd['open_url'];
    } // end _getAdUrl

    /**
     * check the limit is exceeded.
     * If true, no ad will be returned
     *
     */
    protected function _checkLimit()
    {
        $limitSetting = ORM::factory('Settings')->where('name', '=', 'limit')->find();
        $clicks = Session::instance()->get('clicks', 0);

        if(!is_null($limitSetting->value) && intval($limitSetting->value) <= $clicks)
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
        $clicks = Session::instance()->get('clicks', 0);
        $clicks++;
        Session::instance()->set('clicks', $clicks);
        Session::instance()->set(sha1($this->_page), $this->_position);

        $statsSql = 'INSERT INTO `stats` (`date`, `id_country`, `amount_users`)
            VALUES (:date, :idCountry, 1)
            ON DUPLICATE KEY UPDATE `amount_users` = `amount_users` + 1';
        $statsQuery = DB::query(Database::INSERT, $statsSql)
            ->parameters(array(
                ':date'      => date('Y-m-d'),
                ':idCountry' => $this->_countryId
            ))
            ->execute();
    } // end _writeStats
} // end Controller_Api_Ads
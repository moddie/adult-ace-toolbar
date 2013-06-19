<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_Ads extends Controller_Base
{
    public $template = 'layouts/empty';

    protected $_page = '';
    protected $_ads  = array();

    public function action_get()
	{
        $this->_page = $this->request->referrer();
        $country = $this->_getCountry();
        //$country = 'RU';

        $adsSql = 'SELECT * FROM `ads` WHERE :page LIKE CONCAT(\'%\', `website`, \'%\') AND ';

        $countryModel = ORM::factory('Countries')->where('iso', '=', $country)->find();
        if(!is_null($countryModel->pk()))
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
                    ':idCountry'    => $countryModel->pk()
                )
            );

        $result = $adsQuery->execute();

        if($result->count() > 0)
        {
            $this->_ads = $result->as_array('position');
            $this->_filterAds();

            $adUrl = $this->_getAdUrl();

            die('aatAttachAds(\'' . $adUrl . '\')');
        }
	} // end action_get

    /**
     * Wrapper for SxGeo getCountry method
     *
     * @return string Country iso code
     */
    protected function _getCountry()
    {
        require_once DOCROOT . 'vendor/SypexGeo/SxGeo.php';
        $sxGeo = new SxGeo(DOCROOT . 'vendor/SypexGeo/SxGeo.dat');
        $country = $sxGeo->getCountry(REQUEST::$client_ip);
        unset($sxGeo);
        return $country;
    } // end _getCountry

    /**
     *
     * @param array $ads
     * @return array Filtered ads
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

        return $result;
    } // end _filterAds

    /**
     *
     * @param array $ads
     * @return string current ad url
     */
    protected function _getAdUrl()
    {
        $lastPosition = Session::instance()->get(sha1($this->_page), NULL);
        $result = '';
        /*if(!is_null($lastPosition))
        {
            while (key($array) !== $key) {
                if (next($array) === false) throw new Exception('Invalid key');
            }
        }
        else
        {*/
            $currentAd = reset($this->_ads);
            $result = $currentAd['open_url'];
        //}
        return $result;
    } // end _getAdUrl

} // end Controller_Api_Ads
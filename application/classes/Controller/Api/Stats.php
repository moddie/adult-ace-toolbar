<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_Stats extends Controller_Base
{
    public $template = 'layouts/empty';

    protected $_countryIso = '';
    protected $_countryId  = 0;
    protected $_trackingBrowsers = array(
        'chrome',
        'firefox',
        'ie'
    );

    public function action_install()
    {
        $this->_writeStats($this->request->param('id'));
    } // end action_install

    /**
     * Increase users amount for current country on install
     *
     */
    protected function _writeStats($browser)
    {
        $browser = strtolower($browser);
        if(empty($browser) || !in_array($browser, $this->_trackingBrowsers))
        {
            $browser = 'unknown';
        }

        $onDuplicateSql = '`amount_installs_' . $browser . '` = `amount_installs_' . $browser . '` + 1';

        $statsSql = 'INSERT INTO `stats_installs`
            (
                `id_country`,
                `amount_installs_chrome`,
                `amount_installs_firefox`,
                `amount_installs_ie`,
                `amount_installs_unknown`
            )
            VALUES
            (
                :idCountry,
                :amountInstallsChrome,
                :amountInstallsFirefox,
                :amountInstallsIe,
                :amountInstallsUnknown
            )
            ON DUPLICATE KEY UPDATE ' . $onDuplicateSql;

        $this->_getCountry();

        DB::query(Database::INSERT, $statsSql)
            ->parameters(array(
                ':idCountry'             => $this->_countryId,
                ':amountInstallsChrome'  => ($browser === 'chrome') ? 1 : 0,
                ':amountInstallsFirefox' => ($browser === 'firefox') ? 1 : 0,
                ':amountInstallsIe'      => ($browser === 'ie') ? 1 : 0,
                ':amountInstallsUnknown' => ($browser === 'unknown') ? 1 : 0,
            ))
            ->execute();
    } // end _writeStats

    /**
     * Wrapper for SxGeo getCountry method
     *
     * @return string Country iso code
     */
    protected function _getCountry()
    {
        require_once DOCROOT . 'vendor/SypexGeo/SxGeo.php';
        $sxGeo = new SxGeo(DOCROOT . 'vendor/SypexGeo/SxGeo.dat');
        $this->_countryIso = $sxGeo->getCountry(REQUEST::$client_ip);

        $countryModel = ORM::factory('Countries')->where('iso', '=', $this->_countryIso)->find();
        if(!is_null($countryModel->pk()))
        {
            $this->_countryId = $countryModel->pk();
        }

        unset($sxGeo);
    } // end _getCountry
} // end Controller_Api_Stats
<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_Stats extends Controller_Base
{
    public $template = 'layouts/empty';

    protected $_countryIso = '';
    protected $_countryId  = 0;

    public function action_install()
    {
        $this->_writeStats('install');
    } // end action_install

    public function action_uninstall()
    {
        $this->_writeStats('uninstall');
    } // end action_uninstall

    /**
     * Increase users amount for current country on install
     *
     */
    protected function _writeStats($action)
    {
        $onDuplicateSql = '`amount_installs` = `amount_installs` + 1';
        if( $action === 'uninstall' )
        {
            $onDuplicateSql = '`amount_uninstalls` = `amount_uninstalls` + 1';
        }

        $statsSql = 'INSERT INTO `stats_installs` (`id_country`, `amount_installs`, `amount_uninstalls`)
            VALUES (:idCountry, :amountInstalls, :amountUninstalls)
            ON DUPLICATE KEY UPDATE ' . $onDuplicateSql;

        $this->_getCountry();

        DB::query(Database::INSERT, $statsSql)
            ->parameters(array(
                ':idCountry'        => $this->_countryId,
                ':amountInstalls'   => ($action === 'install') ? 1 : 0,
                ':amountUninstalls' => ($action === 'uninstall') ? 1 : 0,
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
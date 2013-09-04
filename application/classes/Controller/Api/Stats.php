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
        $statsSql = 'INSERT INTO `stats_installs` (`date`, `action`, `id_country`, `amount_users`)
            VALUES (:date, :action, :idCountry, 1)
            ON DUPLICATE KEY UPDATE `amount_users` = `amount_users` + 1';

        $this->_getCountry();

        DB::query(Database::INSERT, $statsSql)
            ->parameters(array(
                ':date'      => date('Y-m-d'),
                ':action'    => $action,
                ':idCountry' => $this->_countryId,
                ':ipAddress' => REQUEST::$client_ip
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
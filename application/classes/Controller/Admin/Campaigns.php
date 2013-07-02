<?php defined('SYSPATH') or die('No direct script access.');

const FORM_CSV_PATERNS_FIELD_NAME = 'csv_patterns';
const FORM_CSV_ADURLS_FIELD_NAME  = 'csv_adurls';

class Controller_Admin_Campaigns extends Controller_Auth
{
    public $template = 'layouts/admin';

    public function action_index()
	{
        if (!empty($_POST['delete']))
        {
            $this->_delete(array_keys($_POST['delete']));
        }
        $view = View::factory('scripts/admin/campaigns');
        $page = intval(Arr::get($_GET, 'page', 1));
        $view->page = $page;
        $per_page = 10;
        $filter = intval(Arr::get($_GET, 'filter', 0));
        $campaigns = ORM::factory('Campaigns');
        if ($filter > 0)
        {
            $campaigns->where('id_country', '=', $filter);
        }
        if ($page < 1)
        {
            $page = 1;
        }
        if ($per_page)
        {
            $campaigns->limit($per_page)->offset(($page - 1) * $per_page);
        }
        $pagination_view = new View('pagination/campaigns');
        $pagination_view->page = $page;
        $pagination_view->perpage = $per_page;
        $pagination_view->filter = $filter;
        $pagination_view->count_all = ORM::factory('Campaigns')->count_by_params($filter);
        $view->pagination = $pagination_view->render();
        $view->filter = $filter;
        $view->campaigns = $campaigns->with('countries')->find_all();
        $view->countries = ORM::factory('Countries')->find_all();
		$this->display($view);
	}

    public function action_add()
    {

        if(!empty($_POST))
        {
            /*$name = intval(Arr::get($_GET, 'filter', 0));
            $country = intval(Arr::get($_GET, 'filter', 0));
            $ = intval(Arr::get($_GET, 'filter', 0));
            $filter = intval(Arr::get($_GET, 'filter', 0));*/
        }



        $view = View::factory('scripts/admin/campaigns_add');
        $view->action = 'add';
        $view->countries = ORM::factory('Countries')->find_all();
        $this->display($view);
    }

    public function action_edit()
    {
        $idCampaign = intval(Arr::get($_GET, 'id_campaign', 0));

        $campaign = ORM::factory('Campaigns', $idCampaign);
        if(!$campaign->loaded())
        {
             throw HTTP_Exception::factory(404, 'Campaign not found!');
        }

        if ($this->request->method() === Request::POST)
        {
            // Patterns csv-import
            if(iset($_FILES[FORM_CSV_PATERNS_FIELD_NAME]))
            {
                $validPatterns = Validation::factory($_FILES)
                    ->rule(FORM_CSV_PATERNS_FIELD_NAME, 'Upload::type', array(':value', array('csv', 'txt')));
                if ($validation->check())
                {
                    $newPatters = $this->_parseCsv($FILES[FORM_CSV_PATERNS_FIELD_NAME]['tmp_name']);
                    //TODO: save new patterns
                }
            }
            // end Patterns csv-import

            // Ad urls csv-import
            if(iset($_FILES[FORM_CSV_ADURLS_FIELD_NAME]))
            {
                $validPatterns = Validation::factory($_FILES)
                    ->rule(FORM_CSV_ADURLS_FIELD_NAME, 'Upload::type', array(':value', array('csv', 'txt')));
                if ($validation->check())
                {
                    $newAdUrls = $this->_parseCsv($FILES[FORM_CSV_ADURLS_FIELD_NAME]['tmp_name']);
                    //TODO: save new Ad urls
                }
            }
            // end Ad urls csv-import
        }

        $view = View::factory('scripts/admin/campaigns_add'); //TODO: rename template
        $view->action   = 'edit';
        $view->campaign = $campaign;
        $view->countries = ORM::factory('Countries')->find_all();
        $this->display($view);
    }

    protected function _delete($idCampaign = null)
    {
        if (!empty($idCampaign))
        {
            $campaignsToDelete = ORM::factory('Campaigns');

            if ( is_array($idCampaign) )
            {
                $campaignsToDelete->where('id_campaign', 'in', $idCampaign);
            }
            else
            {
                $campaignsToDelete->where('id_campaign', '=', $idCampaign);
            }
            $campaignsToDelete->find()->delete();
        }
    }

    public function _parseCsv($filePath)
    {
        $result = array();
        if (($f = fopen($filePath, 'rt')) !== FALSE)
        {
            $row = 1;
            while (($data = fgetcsv($f, 2048, ',')) !== FALSE)
            {
                $result[$data[0]] = 0;
                $row++;
            }
            fclose($f);
        }
        if(!empty($result))
        {
            $result = array_keys($result);
        }

        return $result;
    } // end _parseCsv
} // end Controller_Admin_Campaigns

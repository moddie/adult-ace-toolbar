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

    public function action_addedit()
    {
        $view = View::factory('scripts/admin/campaigns_add');
        $errors = array();
        $id = Arr::get($_GET, 'id_campaign', NULL);
        if(empty($id))
        {
            $id = Arr::get($_POST, 'id_campaign', NULL);
        }
        $campaign = ORM::factory('Campaigns', $id);
        /*if(!$campaign->loaded())
        {
             throw HTTP_Exception::factory(404, 'Campaign not found!');
        }*/
        $view->action = 'Add';
        if (!empty($id))
        {
            $view->action = 'Edit';
        }
        
        if(!empty($_POST))
        {
            try
            {
                $campaign->name = Arr::get($_POST, 'c_name');
                $campaign->id_country = intval(Arr::get($_POST, 'country', 0));
                $campaign->click_limit = intval(Arr::get($_POST, 'limit', 0));
                $campaign->save();
            }
            catch (ORM_Validation_Exception $e)
            {
                $errors = $e->errors();
            }
            
            $csvPatterns = $csvAdUrls = array();
            
            $newPatterns = Arr::get($_POST,'patterns',array());
            $newAdUrls = Arr::get($_POST,'urls',array());
            
            // Patterns csv-import
            
            
            //echo '<pre>'; print_r($_FILES); die;
            
            if(!empty($_FILES[FORM_CSV_PATERNS_FIELD_NAME]['name']))
            {
                $validPatterns = Validation::factory($_FILES)
                    ->rule(FORM_CSV_PATERNS_FIELD_NAME, 'Upload::type', array(':value', array('csv', 'txt')));
                if ($validPatterns->check())
                {
                    $csvPatterns = $this->_parseCsv($_FILES[FORM_CSV_PATERNS_FIELD_NAME]['tmp_name']);
                    //TODO: save new patterns
                }
            }
            // end Patterns csv-import

            // Ad urls csv-import
            if(!empty($_FILES[FORM_CSV_ADURLS_FIELD_NAME]['name']))
            {
                $validAdUrls = Validation::factory($_FILES)
                    ->rule(FORM_CSV_ADURLS_FIELD_NAME, 'Upload::type', array(':value', array('csv', 'txt')));
                if ($validAdUrls->check())
                {
                    $csvAdUrls = $this->_parseCsv($_FILES[FORM_CSV_ADURLS_FIELD_NAME]['tmp_name']);
                    //TODO: save new Ad urls
                }
            }
            // end Ad urls csv-import
            
            $patterns = Arr::merge($newPatterns,$csvPatterns);
            $urls = Arr::merge($newAdUrls, $csvAdUrls);
            
            if(!empty($patterns))
            {
                foreach($patterns as $pattern){
                    try
                    {
                        $pat = ORM::factory('WebsitePatterns');
                        $pat->id_campaign = $campaign->id_campaign;
                        $pat->pattern = $pattern;
                        $pat->save();
                    }
                    catch (ORM_Validation_Exception $e)
                    {
                        $errors += $e->errors();
                    }
                }
            }
            if(!empty($urls))
            {
                foreach($urls as $k=>$url){
                    try
                    {
                        $u = ORM::factory('AdUrls');
                        $u->id_campaign = $campaign->id_campaign;
                        $u->target_url = $url;
                        $u->position = $k;
                        $u->save();
                    }
                    catch (ORM_Validation_Exception $e)
                    {
                        $errors += $e->errors();
                    }
                }
            } 
            
            if(empty($errors))   
            {
                Controller::redirect( URL::base(TRUE) . Route::get('admin')->uri(array('controller' => 'campaigns', 'action' => 'index'))); /*. '?id_campaign=' . $campaign->id_campaign )*/
            }
        }
        $view->campaign = $campaign;
        $view->countries = ORM::factory('Countries')->find_all();
        $view->errors = $errors;
        $this->display($view);
    }

    protected function _delete($idCampaign = null)
    {
        if (!empty($idCampaign))
        {
            $campaigns = ORM::factory('Campaigns');

            if ( is_array($idCampaign) )
            {
                $campaigns->where('id_campaign', 'in', $idCampaign);
            }
            else
            {
                $campaigns->where('id_campaign', '=', $idCampaign);
            }
            $campaignsToDelete = $campaigns->find_all();
            if(count($campaignsToDelete) > 0)
            {
                foreach ($campaignsToDelete as $campaign)
                {
                    $campaign->delete();
                }
            }
            
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

<?php defined('SYSPATH') or die('No direct script access.');

const FORM_CSV_PATERNS_FIELD_NAME = 'csv_patterns';
const FORM_CSV_ADURLS_FIELD_NAME  = 'csv_adurls';

class Controller_Admin_Quotes extends Controller_Auth
{
    public $template = 'layouts/admin';

    public function action_index()
    {
        if (!empty($_POST['delete']))
        {
            $this->_delete(array_keys($_POST['delete']));
        }
        $view = View::factory('scripts/admin/quotes');
        $page = intval(Arr::get($_GET, 'page', 1));
        $view->page = $page;
        $per_page = 10;        
        $orm = ORM::factory('Citates');        
        
        if ($page < 1)
        {
            $page = 1;
        }
        if ($per_page)
        {
            $orm->limit($per_page)->offset(($page - 1) * $per_page);
        }
        
        $this->template->title = "Quotes";        
        $pagination_view = new View('pagination/images');
        $pagination_view->page = $page;
        $pagination_view->perpage = $per_page;        
        $pagination_view->count_all = ORM::factory('Citates')->count_all();
        $view->pagination = $pagination_view->render();                
        
        $view->search = '';
        $view->quotes = ORM::factory('Citates')
                                ->order_by('id','asc')
                                ->find_all();        
	$this->display($view);
    }
    
    public function action_search()
    {
        $q = trim(Arr::get($_GET, 'q', NULL));
                
        $view = View::factory('scripts/admin/quotes');
        $page = intval(Arr::get($_GET, 'page', 1));
        $view->page = $page;
        $per_page = 10;        
        $orm = ORM::factory('Citates');        
        
        if ($page < 1)
        {
            $page = 1;
        }
        if ($per_page)
        {
            $orm->limit($per_page)->offset(($page - 1) * $per_page);
        }
        
        $this->template->title = "Quotes";        
        $pagination_view = new View('pagination/images');
        $pagination_view->page = $page;
        $pagination_view->perpage = $per_page;        
        $pagination_view->count_all = ORM::factory('Citates')->count_all();        
        $view->pagination = $pagination_view->render();        
        
        $view->search = $q;
        $view->quotes = ORM::factory('Citates')
                                ->order_by('id','asc')
                                ->where('text', 'LIKE', '%'.$q.'%')
                                ->or_where('author', 'LIKE', '%'.$q.'%')
                                ->find_all();
	$this->display($view);
    }

    public function action_addedit()
    {
        $view = View::factory('scripts/admin/quote_add');
        $errors = array();
        $view->debug = 0;
        $id = Arr::get($_GET, 'id', '');
        
        if(empty($id))
        {
            $view->action = 'Add';
            $this->template->title = "Add User";
            $view->quote = array(
                'id'=>'', 
                'text'=>'', 
                'author'=>'', 
                'current'=>0
            );
        }   
        else 
        {
            $view->action = 'Edit';
            $this->template->title = "Edit User";
            
            $edit = ORM::factory('Citates', $id);
            if($edit->loaded())
            {
                 $view->quote = array(
                     'id' => $id,
                     'text' => $edit->text,
                     'author' => $edit->author,
                     'current' => $edit->current,
                 );
            }
            else
            {
                throw HTTP_Exception::factory(404, 'Quote not found!');
            }
        }
        
        if(!empty($_POST))
        {               
            $post = array();
            $post['id'] = $id;
            $post['text'] = Arr::get($_POST, 'text', NULL);
            $post['author'] = Arr::get($_POST, 'author', NULL);
            $post['current'] = intval(Arr::get($_POST, 'current', 0));            
            $view->quote = $post;
            
            if (empty($post['author']))                
            {
                $errors['author'] = 'Empty field author';
            }
            if (empty($post['text']))                
            {
                $errors['title'] = 'Empty field title';
            }           
            
            if(empty($errors))   
            {                   
                $data = array();
                $data['text'] = $post['text'];
                $data['author'] = $post['author'];                
                $data['current'] = $post['current'];                

                if ($view->action == "Add") 
                {    
                    $data['last_time'] = NULL;
                    $data['status'] = 1;
                    ORM::factory('Citates')->values($data)->save();
                }
                else
                {
                    ORM::factory('Citates', $id)->values($data)->save();
                }
                Controller::redirect( URL::base(TRUE) . Route::get('admin')->uri(array('controller'=>'quotes', 'action'=>'index')));                    
            }
        }                      
        $view->errors = $errors;        
        $this->display($view);
    }
    
    
    public function action_import()
    {
        if ($_FILES['upload']['error'] == 0)
        {   
            $file = $_FILES['upload']['tmp_name'];
            if ($fp = fopen($file, "r")) 
            {
                $index = 0;
                while (!feof($fp))
                {
                    $line = fgets($fp, 999);                    
                    if ($index++ == 0) 
                    {
                        continue;
                    }          
                    $exp = explode('|', $line);
                    if (is_array($exp) && count($exp) == 2)
                    {
                        $author = $exp[0];
                        $quote = $exp[1];  
                        
                        $find = ORM::factory('Citates')->where('text','=',$quote)->find();
                        if (!$find->loaded())
                        {
                            $obj = ORM::factory('Citates');
                            $obj->text = $quote;
                            $obj->author = $author;
                            $obj->status = 1;
                            $obj->current = 0;
                            $obj->last_time = NULL;
                            $obj->save();
                        }
                    }
                }
            }            
            fclose($fp);
        }        
        Controller::redirect( URL::base(TRUE) . Route::get('admin')->uri(array('controller'=>'quotes', 'action'=>'index')));
    }
    
    
    protected function _delete($ids = null)
    {
        if (!empty($ids))
        {
            $orm = ORM::factory('Citates');

            if ( is_array($ids) )
            {
                $orm->where('id','in',$ids);
            }
            else
            {
                $orm->where('id','=',$ids);
            }
            $quotesToDelete = $orm->find_all();
            if(count($quotesToDelete) > 0)
            {
                foreach ($quotesToDelete as $quote)
                {
                    $quote->delete();
                }
            }
            
        }
    }    

} // end Controller_Admin_Images

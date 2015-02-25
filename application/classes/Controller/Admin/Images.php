<?php defined('SYSPATH') or die('No direct script access.');

const FORM_CSV_PATERNS_FIELD_NAME = 'csv_patterns';
const FORM_CSV_ADURLS_FIELD_NAME  = 'csv_adurls';

class Controller_Admin_Images extends Controller_Auth
{
    public $template = 'layouts/admin';

    public function action_index()
    {
        if (!empty($_POST['delete']))
        {
            $this->_delete(array_keys($_POST['delete']));
        }
        $view = View::factory('scripts/admin/images');
        $page = intval(Arr::get($_GET, 'page', 1));
        $view->page = $page;
        $per_page = 10;        
        $images = ORM::factory('Images');        
        
        if ($page < 1)
        {
            $page = 1;
        }
        if ($per_page)
        {
            $images->limit($per_page)->offset(($page - 1) * $per_page);
        }
        
        $this->template->title = "Images";        
        $pagination_view = new View('pagination/images');
        $pagination_view->page = $page;
        $pagination_view->perpage = $per_page;        
        $pagination_view->count_all = ORM::factory('Images')->count_all();
        $view->pagination = $pagination_view->render();                
        $view->images = ORM::factory('Images')->order_by('id','asc')->find_all();        
        
	$this->display($view);
    }

    public function action_addedit()
    {
        $view = View::factory('scripts/admin/images_add');
        $errors = array();
        $view->debug = 0;
        $id = Arr::get($_GET, 'id', '');
        
        if(empty($id))
        {
            $view->action = 'Add';
            $this->template->title = "Add User";
            $view->image = array(
                'id'=>'', 
                'title'=>'', 
                'file'=>'', 
                'current'=>0
            );
        }   
        else 
        {
            $view->action = 'Edit';
            $this->template->title = "Edit User";
            
            $edit = ORM::factory('Images', $id);
            if($edit->loaded())
            {
                 $view->image = array(
                     'id' => $id,
                     'title' => $edit->title,
                     'file' => $edit->file,
                     'current' => $edit->current,
                 );
            }
            else
            {
                throw HTTP_Exception::factory(404, 'Image not found!');
            }
        }
        
        if(!empty($_POST))
        {               
            $post = array();
            $post['id'] = $id;
            $post['title'] = Arr::get($_POST, 'title', NULL);
            $post['file'] = empty($_FILES) ? '' : $_FILES['file']['name'];
            $post['current'] = intval(Arr::get($_POST, 'current', 0));            
            $view->image = $post;
            
            if (empty($post['title']))                
            {
                $errors['title'] = 'Empty title';
            }
            if ($_FILES['file']['error'] != 0)
            {                
                $errors['file'] = 'Please, choose file';
            }            
            
            if(empty($errors))   
            {   
                $uploadPath = '/images/upload/';
                $uploadFullPath = $_SERVER['DOCUMENT_ROOT'] . $uploadPath;                
                if (!file_exists($uploadFullPath))
                {
                    mkdir($uploadFullPath);
                }                
                
                $sp = '_';
                $exp = explode('/', $_FILES['file']['tmp_name']);
                $tmp = $exp[ count($exp) - 1 ];                
                $preffix = substr($tmp, 3);
                
                $newFileName = $preffix . $sp . $_FILES['file']['name'];
                
                $tmpfile = $_FILES['file']['tmp_name'];
                $newfile = $uploadFullPath . $newFileName;
                
                if (move_uploaded_file($tmpfile, $newfile))
                {
                    $data = array();
                    $data['title'] = $post['title'];
                    $data['file'] = $uploadPath . $newFileName;                    
                    $data['current'] = $post['current'];                    
                    $data['created_time'] = time();
                    
                    if ($view->action == "Add") 
                    {    
                        $data['status'] = 1;  
                        $data['last_time'] = NULL;
                        ORM::factory('Images')->values($data)->save();
                    }
                    else
                    {
                        ORM::factory('Images', $id)->values($data)->save();
                    }
                    Controller::redirect( URL::base(TRUE) . Route::get('admin')->uri(array('controller'=>'images', 'action'=>'index')));
                }    
            }
        }                      
        $view->errors = $errors;        
        $this->display($view);
    }
    
    protected function _delete($ids = null)
    {
        if (!empty($ids))
        {
            $image = ORM::factory('Images');

            if ( is_array($ids) )
            {
                $image->where('id','in',$ids);
            }
            else
            {
                $image->where('id','=',$ids);
            }
            $imgToDelete = $image->find_all();
            if(count($imgToDelete) > 0)
            {
                foreach ($imgToDelete as $img)
                {
                    $img->delete();
                }
            }
            
        }
    }
    

} // end Controller_Admin_Images

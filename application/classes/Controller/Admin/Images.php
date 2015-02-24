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
        $view = View::factory('scripts/admin/users_add');
        $errors = array();
        $id = Arr::get($_GET, 'id_user', NULL);
        if(empty($id))
        {
            $view->action = 'Add';
            $this->template->title = "Add User";
            $view->user = ORM::factory('Users')->find($id);
        }   
        else 
        {
            $view->action = 'Edit';
            $this->template->title = "Edit User";
            
            $view->user = ORM::factory('Users')->find($id);
            if(!$view->user)
            {
                 throw HTTP_Exception::factory(404, 'User not found!');
            }
        }
        
        if(!empty($_POST))
        {   
            try
            {  
                $password = intval(Arr::get($_POST, 'password', 0));
                $confirm_password = intval(Arr::get($_POST, 'password2', 0));
                if ($password == $confirm_password) 
                {
                    $pwd = Auth::instance()->hash_password($password);
                    $data = array();
                    $data['username'] = Arr::get($_POST, 'u_name');
                    $data['password'] = Arr::get($_POST, $pwd);
                    $data['email'] = Arr::get($_POST, 'email', null);
                    $data['created'] = time();                    
                }
                else
                {
                    $errors['password'] = 'Incorrect password. Please retry';
                }
                
            }
            catch (ORM_Validation_Exception $e)
            {
                $errors = $e->errors('');
            }
            
            if(empty($errors))   
            {
                if ($view->action == "Add") 
                {            
                    ORM::factory('Users')->values($data)->save();
                }
                else
                {
                    ORM::factory('Users', $id)->values($data)->save();
                }
                Controller::redirect( URL::base(TRUE) . Route::get('admin')->uri(array('controller' => 'users', 'action' => 'addedit')) . ((!empty($id)?('?id_user='.$id):'')));
            }
        }        
        
        $view->errors = $errors;
        $this->display($view);
    }
    
    protected function _delete($idUsers = null)
    {
        if (!empty($idUsers))
        {
            $user = ORM::factory('User');

            if ( is_array($idUsers) )
            {
                $user->where('id', 'in', $idUsers);
            }
            else
            {
                $user->where('id', '=', $idUsers);
            }
            $userToDelete = $user->find_all();
            if(count($userToDelete) > 0)
            {
                foreach ($userToDelete as $usr)
                {
                    $usr->delete();
                }
            }
            
        }
    }
    

} // end Controller_Admin_Images

<?php defined('SYSPATH') or die('No direct script access.');

const FORM_CSV_PATERNS_FIELD_NAME = 'csv_patterns';
const FORM_CSV_ADURLS_FIELD_NAME  = 'csv_adurls';

class Controller_Admin_Users extends Controller_Auth
{
    public $template = 'layouts/admin';

    public function action_index()
    {
        if (!empty($_POST['delete']))
        {
            $this->_delete(array_keys($_POST['delete']));
        }
        $view = View::factory('scripts/admin/users');
        $page = intval(Arr::get($_GET, 'page', 1));
        $view->page = $page;
        $per_page = 10;        
        $users = ORM::factory('Users');        
        
        if ($page < 1)
        {
            $page = 1;
        }
        if ($per_page)
        {
            $users->limit($per_page)->offset(($page - 1) * $per_page);
        }
        
        $this->template->title = "Users";        
        $pagination_view = new View('pagination/users');
        $pagination_view->page = $page;
        $pagination_view->perpage = $per_page;        
        $pagination_view->count_all = ORM::factory('Users')->count_all();
        $view->pagination = $pagination_view->render();                
        $view->users = ORM::factory('Users')->order_by('id','asc')->find_all();        
        
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
    
    public function action_block() 
    {
        $view = View::factory('scripts/admin/user_block');
        $id = Arr::get($_GET, 'id', NULL);
        $action = Arr::get($_GET, 'action', 'block'); 
        $user = ORM::factory('Users')->find($id);
        
        if ($action == 'block' && $user->status == 'unblock') 
        {
            $user->status = 'block';
            $user->save();
        }
        else if ($action == 'unblock' && $user->status == 'block')
        {
            $user->status = 'unblock';
            $user->save();
        }
        
        $view->user = $user;        
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
    
    public function action_add()
    {
        $view = View::factory('scripts/admin/user_add');        
	$this->display($view);
    }
    
    public function action_login()
    {
        $view = View::factory('scripts/admin/login_api');        
	$this->display($view);
    }

} // end Controller_Admin_Campaigns

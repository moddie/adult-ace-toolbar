<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_User extends Controller_Base
{
    public $template = 'layouts/empty';
        
    public function action_register()
    {           
        $user['username']  = Arr::get($_POST, 'username', NULL);
        $user['password']  = Arr::get($_POST, 'password', NULL);
        $user['email']     = Arr::get($_POST, 'email', NULL);
        $this->_insert_user($user);
    }
    
    public function action_check()
    {          
        $json["status"] = $this->_check_email_token();                
        $this->display_ajax(json_encode($json));
    }
    
    public function action_login()
    {
        $user['email']     = Arr::get($_POST, 'email', NULL);
        $user['password']  = Arr::get($_POST, 'password', NULL);       
           
        $post = Validation::factory($user); 
        $post->rule('email', 'email');
        if(!$post->check())                    
        {
            $json['status'] = 0;
            $json['message'] = 'Please entry valid email';            
        }
        
        if (empty($user['email']))
        {
            $json['status'] = 0;
            $json['message'] = 'Empty field: email';             
        }
        if (empty($user['password']))
        {
            $json['status'] = 0;
            $json['message'] = 'Empty field: password';             
        }
           
        $pwd = Auth::instance()->hash_password($user['password']);
        
        $users = ORM::factory('Users')->where('email','=',$user['email'])->find();        
        if ($users->loaded()) 
        {
            $res = ORM::factory('Users')->where('email','=',$user['email'])->and_where('password','=',$pwd)->find();
            if ($res->loaded())
            {
                $json['status'] = 1;
                $json['message'] = 'Authorization completed';                     
            }
            else
            {
                $json['status'] = 0;
                $json['message'] = 'Incorrect password';
            }            
        }
        else
        {
            $json['status'] = 0;
            $json['message'] = 'User is not registered';
        }
        
        $json['data'] = '';
        $this->display_ajax(json_encode($json));
    }
    
    public function action_getData()
    {   
        $json = array();        
        $user_id  = Auth::instance()->get_user();        
        
        $data['image'] = $this->_get_data_images();
        $data['quote'] = $this->_get_data_citates();
        
        $user = ORM::factory('Users', $user_id);
        if ($user->loaded())
        {   
            $data['task_categories'] = $this->_get_data_task_categories($user->id);
            $data['task'] = $this->_get_data_task($user->id);
            $data['bookmarks'] = $this->_get_data_bookmarks($user->id);             
            $json['success'] = 1;
        }
        else
        {
            $json['success'] = 0;
        }        
        $json['data'] = $data;         
        $this->display_ajax(json_encode($json));
    }
    
    public function _insert_user($user)
    {   
        $json = array();
        $json['status'] = 1;
        
        if (empty($user['username']))
        {
            $json['status'] = 0;
            $json['message'] = 'Empty field: username';             
        }
        else if(empty($user['password']))
        {
            $json['status'] = 0;
            $json['message'] = 'Empty field: password';             
        }
        else if (empty($user['email']))
        {
            $json['status'] = 0;
            $json['message'] = 'Empty field: email';             
        }
        
        $users = ORM::factory('Users')->where('username','=',$user['username'])->or_where('email','=',$user['email'])->find();        
        if ($users->loaded()) 
        {
            $json['status'] = 0;
            $json['message'] = 'The field is already exists';                     
        }
           
        $post = Validation::factory($user); 
        $post->rule('email', 'email');
        if(!$post->check())                    
        {
            $json['status'] = 0;
            $json['message'] = 'Please entry valid email';            
        }
        
        //Save data
        if ($json['status'] !== 0)
        {
            $data['username'] = $user['username'];
            $data['password'] = Auth::instance()->hash_password($user['password']);                
            $data['email'] = $user['email'];                    
            $data['email_required'] = 0;
            $data['email_token'] = md5($user['username']);
            $data['status'] = 'block';            
            $data['logins'] = time();
            $data['last_login'] = time();
            $data['created'] = time();                
            ORM::factory('Users')->values($data)->save();
            
            //Send Email            
            $swiftmailer = Email::factory('title', 'message');
            $msg = '<p>Confirm your email address to complete your Twitter account.' .
                   'It\'s easy — just click on this link:</p>' . 
                   'http://'. APPPATH . '/api/user/check?token=' . $data['email_token'];
            $swiftmailer->message($msg, 'text/html');
            $swiftmailer->from('test@test.ru')->to($user['email'])->send();

            $json['status'] = 1;                       
        }            
        
        $json['data'] = '';         
        $this->display_ajax(json_encode($json));
    }
    
    public function _check_email_token()
    {
        $token = Arr::get($_GET, 'token', NULL);
        $user = ORM::factory('Users')->where('email_token','=',$token)->find();
        return $user->loaded();
    }
    
    protected function _get_data_images()
    {
        $json = array();  
        $save_item = false;
        $image_id = null;
        
        $time = ORM::factory('CurrentImages')->order_by('last_time','DESC')->limit(1)->find();
        if ($time->loaded())
        {
            $image_id = $time->image_id;
            $last_time = $time->last_time;            
            $current_time = Date::formatted_time('now'); 
            
            if (($current_time - $last_time) > 12*60*60){
                $save_item = true;
            }
        }
        else {
            $save_item = true;
        }
        
        $images = ORM::factory('Images')->find_all();
        foreach ($images as $image)
        {
            $item['id'] = $image->id;
            $item['title'] = $image->title;
            $item['file'] = $image->file;
            $item['status'] = $image->status;
            $data[] = $item;
        }        
        
        if ($save_item) 
        {            
            $index = rand(0,count($data)-1);
            $new_item['image_id'] = $index;            
            ORM::factory('CurrentImages')->values($new_item)->save();            
            
            return $data[$index];
        }
        else
        {
            $image = ORM::factory('Images')->where('id','=',$image_id)->find();
            if ($image->loaded())
            {
                $item['id'] = $image->id;
                $item['title'] = $image->title;
                $item['file'] = $image->file;
                $item['status'] = $image->status;
                return $item;
            }
        }
        
    }
    
    protected function _get_data_citates()
    {
        $json = array();   
        $save_item = false;
        $citate_id = null;
        
        $time = ORM::factory('CurrentCitates')->order_by('last_time','DESC')->limit(1)->find();
        if ($time->loaded())
        {
            $citate_id = $time->citate_id;            
            $last_time = $time->last_time;                        
            $current_time = Date::formatted_time('now');           
            
            if (($current_time - $last_time) > 12*60*60){
                $save_item = true;
            }
        }
        else {
            $save_item = true;
        }
        
        $citates = ORM::factory('Citates')->find_all();
        foreach ($citates as $quote)
        {
            $item['id'] = $quote->id;
            $item['text'] = $quote->text;
            $item['author'] = $quote->author;
            $item['status'] = $quote->status;
            $data[] = $item;
        }
        
        if ($save_item) 
        {
            $index = rand(0,count($data)-1);
            $new_item['citate_id'] = $index;            
            ORM::factory('CurrentCitates')->values($new_item)->save();            
        }
        else
        {
            $quote = ORM::factory('Citates')->where('id','=',$citate_id)->find();
            if ($quote->loaded())
            {
                $item['id'] = $quote->id;
                $item['text'] = $quote->text;
                $item['author'] = $quote->author;
                $item['status'] = $quote->status;
                return $item;
            }
        }        
        return $data[$index];
    }
    
    protected function _get_data_task($user_id)
    {
        $data = array();        
        
        $tasks = ORM::factory('Tasks')->where('user_id','=',$user_id)->find_all()->as_array();
        foreach ($tasks as $task) 
        {
            $item['id'] = $task->id;
            $item['user_id'] = $task->user_id;
            $item['category_id'] = $task->category_id;
            $item['title'] = $task->title;   
            $item['text'] = $task->text;   
            $item['status'] = $task->status;   
            $item['date_create'] = $task->date_create;   
            $item['date_update'] = $task->date_update;   
            $data[] = $item;
        }
        return $data;
    }
    
    protected function _get_data_task_categories($user_id)
    {
        $data = array();        
        
        $task_categories = ORM::factory('TaskCategories')->where('user_id','=',$user_id)->find_all()->as_array();
        foreach ($task_categories as $category) 
        {
            $item['id'] = $category->id;
            $item['user_id'] = $category->user_id;
            $item['pid'] = $category->pid;
            $item['name'] = $category->name;            
            $data[] = $item;
        }
        return $data;
    }
    
    protected function _get_data_bookmarks($user_id)
    {
        $data = array();
        
        $bookmarks = ORM::factory('Bookmarks')->where('user_id','=',$user_id)->find_all();
        foreach ($bookmarks as $bookmark) 
        {            
            $item['id'] = $bookmark->id;
            $item['user_id'] = $bookmark->user_id;
            $item['name'] = $bookmark->name;
            $item['url'] = $bookmark->url;
            $item['date_create'] = $bookmark->date_create;            
            $data[] = $item;
        }
        return $data;
    }

}
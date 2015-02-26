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
    
    public function action_resend()
    {           
        $email = Arr::get($_POST, 'email');
        
        $json['status'] = 0;
        
        $user = ORM::factory('User')->where('email', '=', $email)->find();
        if( $user->pk() )
        {
            $send = $this->_send_email($user->email, $user->email_token);
            if( $send )
            {
                $json['status'] = 1;
            }   
        }

        $this->display_ajax(json_encode($json));
    }
    
    public function action_checktoken()
    {          
        $token = Arr::get($_GET, 'token', NULL);
        $json["status"] = $this->_check_email_token($token);
        $this->display_ajax(json_encode($json));
    }
    
    public function action_checkEmail()
    {          
        $email = Arr::get($_GET, 'email', NULL);
        if (empty($email))
        {            
            $json['status'] = 0;
            $json['message'] = 'Empty field: email';
        }
        else
        {
            $valid['email'] = $email;
            $post = Validation::factory($valid); 
            $post->rule('email', 'email');            
            if(!$post->check()) 
            {               
                $json['status'] = 0;
                $json['isValid'] = 0;
                $json['message'] = 'Please entry valid email';
            }
            else
            {
                $json['status'] = 0;
                $json['isValid'] = 1;                       
            }
            
            if ($json['isValid'] == 1)
            {
                $user = ORM::factory('Users')->where('email','=',$email)->find();
                if ($user->loaded())
                {
                    if ($user->status == 'active')
                    {
                        $json['isRegistered'] = 1;
                        $json['status'] = 1;
                    }
                    elseif ($user->status == 'not active')
                    {
                        $json['isRegistered'] = 0;                        
                        $json['message'] = 'This email is not required';
                    }
                    else
                    {
                        $json['isRegistered'] = 0;
                    }
                }
                else
                {
                    $json['isRegistered'] = 0;                
                    $json['message'] = 'This email is not registered';
                }
            }
        }       
        
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
                $data['username'] = $res->username;
                $data['access_token'] = $res->access_token;
                $json['user'] = $data;
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
        
        //$token = Arr::get($_GET, 'token', '');
        $token = $this->request->headers('X-Auth-Token');        
        $user = ORM::factory('Users')->where('access_token','=',$token)->find();        
        if (!empty($token) && $user->loaded() || true)
        {
            if ($token == $user->access_token) 
            {         
                $usr['email'] = $user->email;
                $usr['username'] = $user->username;                
                $usr['access_token'] = $user->access_token;
                
                $data['user'] = $usr;
                $data['image'] = $this->_get_data_image();
                $data['quote'] = $this->_get_data_quote();               
                $data['task'] = $this->_get_data_task($user->id);
                $data['bookmarks'] = $this->_get_data_bookmarks($user->id);             
                
                $json['data'] = $data;         
                $json['status'] = 1;
            }
            else
            {
                $json['status'] = 0;
                $json['message'] = 'X-Auth-Token not find in database';
            }            
        }    
        else
        {
            $json['status'] = 0;
            $json['message'] = 'Please entry valid X-Auth-Token';
        }        
        $this->display_ajax(json_encode($json));
    }
    
    public function _insert_user($user_data)
    {   
        $json = array();
        $json['status'] = 1;
        
        if (empty($user_data['username']))
        {
            $json['status'] = 0;
            $json['message'] = 'Empty field: username';             
        }
        else if(empty($user_data['password']))
        {
            $json['status'] = 0;
            $json['message'] = 'Empty field: password';             
        }
        else if (empty($user_data['email']))
        {
            $json['status'] = 0;
            $json['message'] = 'Empty field: email';             
        }
        
        $post = Validation::factory($user_data); 
        $post->rule('email', 'email');
        if(!$post->check())                    
        {
            $json['status'] = 0;
            $json['message'] = 'Please entry valid email';            
        }
        
        $post = Validation::factory($user_data); 
        $post->rule('password', 'min_length', array(':value', 6));
        if(!$post->check())                    
        {
            $json['status'] = 0;
            $json['message'] = 'The password must be 6 characters';            
        }
        
        //Save data
        if ($json['status'] !== 0)
        {            
            $data['username'] = $user_data['username'];
            $data['password'] = Auth::instance()->hash_password($user_data['password']);
            $data['email'] = $user_data['email'];            
            $data['email_token'] = md5($user_data['username']);
            $data['status'] = 'not active';
            $data['logins'] = 1;
            $data['last_login'] = time();
            $now = Date::formatted_time('now'); 
            $data['created'] = $now;
            
            //Save User Data
            $users = ORM::factory('Users')->where('email','=',$user_data['email'])->find();        
            if ($users->loaded()) 
            {
                if ($users->status = 'not active')
                {
                    //Send Email            
                    $send = $this->_send_email($user_data['email'], $data['email_token']);
                    if ($send)
                    {
                        $json['status'] = 1;
                    }                     
                    $json['message'] = 'Email sent';
                }
                else
                {
                    $json['status'] = 0;
                    $json['message'] = 'This login is already exists';
                }
            }
            else
            {
                ORM::factory('Users')->values($data)->save();                             
                //Send Email            
                $send = $this->_send_email($user_data['email'], $data['email_token']);
                if ($send)
                {
                    $json['status'] = 1;
                } 
            }
                        
            
            
            //Return Data
            unset($data['email_token']);
            unset($data['password']);
            $json['data'] = $data;
        }            
        
        $this->display_ajax(json_encode($json));
    }
    
    public function _check_email_token($token)
    {
        if (!empty($token)) {            
            $user = ORM::factory('Users')->where('email_token','=',$token)->find();
            if ($user->loaded())
            {
                $user->access_token = md5($user->email . $user->password);
                $user->status = 'active';
                $user->save();
                return 1;
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return 0;
        }
    }
    
    protected function _send_email($email, $token)
    {
        $swiftmailer = Email::factory('Ace Toolbar', 'message');
        $msg = '<p>Confirm your email address to complete your account.' .
               'It\'s easy — just click on this link:</p>' . 
               URL::base(true) . 'api/user/checktoken?token=' . $token;            
        $swiftmailer->message($msg, 'text/html');
        return $swiftmailer->from('info@adultace.net')->to($email)->send();            
    }
    
    protected function _get_data_image()
    {
        $currentId = 0;
        $last_time = 0;                
        $freeImages = array();
        
        // Search current ad free images
        $images = ORM::factory('Images')->find_all();
        foreach ($images as $image)
        {            
            if ($image->current)
            {
                $currentId = $image->id;
                $last_time = $image->last_time;                
            }
            else
            {
                $freeImages[] = $image->id;
            }
        }
        
        // update current image
        if ($currentId !== 0)
        {
            $current_time = time();
            if (strlen(strval($last_time)) == 10 && count($freeImages) > 0)
            {
                if(($current_time - $last_time) > 12*3600)
                {
                    $rand = rand(0, count($freeImages) - 1);                
                    $newId = $freeImages[$rand];
                    
                    $img = ORM::factory('Citates', $newId);
                    if ($img->loaded())
                    {                                        
                        $img->last_time = $current_time;                    
                        $img->current = 1;
                        $img->save();
                    }
                }
                else
                {
                    $img = ORM::factory('Citates', $currentId);
                    if ($img->loaded())
                    {                  
                        $img->current = 1;
                        $img->save();
                    }
                } 
            }
            else
            {
                $img = ORM::factory('Images', $currentId);
                if ($img->loaded())
                {
                    $img->current = 1;
                    $img->last_time = $current_time;
                    $img->save();
                }
            }
        }
        
        // return image data
        $image = ORM::factory('Images')->where('current','=',1)->find();
        if ($image->loaded())
        {
            $item = array();
            $item['id'] = $image->id;
            $item['title'] = $image->title;
            $item['file'] = $image->file;
            $item['status'] = $image->status;
            $item['current'] = $image->current;
            $item['last_time'] = $image->last_time;
            return $item;
        }
    }
    
    protected function _get_data_quote()
    {
        $currentId = 0;
        $last_time = 0;        
        $freeQuotes = array();
        
        // Search current ad free Quotes
        $quotes = ORM::factory('Citates')->find_all();
        foreach ($quotes as $quote)
        {            
            if ($quote->current)
            {
                $currentId = $quote->id;
                $last_time = $quote->last_time; 
                // Save
                $quote->current = 0;
                $quote->save();
            }
            else
            {
                $freeQuotes[] = $quote->id;
            }
        }
                
        // update current Quote
        if ($currentId !== 0)
        {
            $current_time = time();
            if (strlen(strval($last_time)) == 10 && count($freeQuotes) > 0)
            {                
                if(($current_time - $last_time) > 12*3600)
                {
                    $rand = rand(0, count($freeQuotes) - 1);                
                    $newId = $freeQuotes[$rand];
                    
                    $qt = ORM::factory('Citates', $newId);
                    if ($qt->loaded())
                    {                                        
                        $qt->last_time = $current_time;                    
                        $qt->current = 1;
                        $qt->save();
                    }
                }
                else
                {
                    $qt = ORM::factory('Citates', $currentId);
                    if ($qt->loaded())
                    {                  
                        $qt->current = 1;
                        $qt->save();
                    }
                }  
            }
            else
            {
                $qt = ORM::factory('Citates', $currentId);
                if ($qt->loaded())
                {
                    $qt->current = 1;
                    $qt->last_time = strval($current_time);
                    $qt->save();
                }
            }
        }
        
        // return Quote data
        $quote = ORM::factory('Citates')->where('current','=',1)->find();
        if ($quote->loaded())
        {
            $item = array();
            $item['id'] = $quote->id;
            $item['title'] = $quote->text;
            $item['file'] = $quote->author;
            $item['status'] = $quote->status;
            $item['current'] = $quote->current;
            $item['last_time'] = $quote->last_time;
            return $item;
        }        
    }
    
    protected function _get_data_task($user_id)
    {
        $data = array();        
        
        $tasks = ORM::factory('Tasks')->where('user_id','=',$user_id)->find_all()->as_array();
        foreach ($tasks as $task) 
        {
            $item['id'] = $task->id;
            $item['user_id'] = $task->user_id;
            $item['parent_id'] = $task->parent_id;              
            $item['is_category'] = $task->is_category;
            $item['order'] = $task->order;
            $item['text'] = $task->text;   
            $item['status'] = $task->status;   
            $item['date_create'] = $task->date_create;   
            $item['date_update'] = $task->date_update;
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
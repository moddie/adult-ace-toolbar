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

}
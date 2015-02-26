<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_Auth extends Controller_Base {
    
   protected $_auth_token;

   public function __construct($request, $response) {
       parent::__construct($request, $response);
   }
  
   public function auth_user()
   {
       $token = $this->_get_auth_token();
       if (!empty($token)) {           
           return $this->_user_by_token($token);
       }
       else {           
           return false;
       }       
   }
   
   protected function _user_by_token($token)
   {
       $user = ORM::factory('Users')->where('access_token','=',$token)->find();               
       if ($user->loaded()) {
           return $user;
       }
       else {
           return false;
       }
   }
  
   protected function _get_auth_token()
   {
       $this->_auth_token = $this->request->headers('X-Auth-Token');;
       return $this->_auth_token;
   }

}
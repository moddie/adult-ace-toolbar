<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_Bookmarks extends Controller_Api_Auth
{
    public $template = 'layouts/empty';
    
    /* 
     * Synchronize the bookmarks
     * @url 
     *      /api/bookmarks/synch
     * @method
     *      POST 
     * @header
     *      X-Auth-Token: access_token
     * @params         
     *      bookmarks = json array(bookmark1, bookmark2, bookmark3...)
     *          where bookmark1..N = array(0=>name, 1=>url)
     * @return 
     *      status  = [0/1]
     *      message = 'error message';
     */
    public function action_synch()
    {      
        $json = array();                
        $bookmarks = Arr::get($_POST, 'bookmarks', NULL);
        
        if (!empty($bookmarks))
        {
            // Auth user
            if ($user = $this->auth_user())
            {                
                $bookmarksArray = json_decode($bookmarks, true);                
                 
                foreach ($bookmarksArray as $newBookmark)
                {   
                    $bmName = $newBookmark[0];
                    $bmUrl = $newBookmark[1];
                    if (!empty($bmUrl))
                    {
                        $oldBookmark = ORM::factory('Bookmarks')->where('user_id','=',$user->id)
                                        ->and_where('url','=',$bmUrl)
                                        ->find();

                        if (!$oldBookmark->loaded())
                        {
                            $data = array();
                            $data['user_id'] = $user->id;
                            $data['name'] = $bmName;
                            $data['url'] = $bmUrl;
                            $data['date_create'] = date('Y-m-d H:i:s');
                            // Save
                            ORM::factory('Bookmarks')->values($data)->save();                            
                            $json['new_bookmarks'][] = array($bmName, $bmUrl);
                        }
                    }
                }
                $json['status'] = 1;
            }
            else
            {
                $json['status'] = 0;
                $json['message'] = 'Access denied';
            }
        }    
        $this->display_ajax(json_encode($json));        
    }
    
    /* 
     * List of tasks and category     
     * @url 
     *      /api/bookmarks/list
     * @method
     *      POST
     * @header
     *      X-Auth-Token: access_token     
     * @return 
     *      status  = [0/1]
     *      message = 'error message';
     * 
     */     
    public function action_list()
    {
        $json = array();
        $json['items'] = array();
        
        if ($user = $this->auth_user())
        {       
            $orm = ORM::factory('Bookmarks');
            $bookmarks = $orm->where('user_id','=',$user->id)->find_all();
            foreach ($bookmarks as $bookmark)
            {
                $data = array();                
                $data['id'] = $bookmark->id;
                $data['user_id'] = $bookmark->user_id;
                $data['name'] = $bookmark->name;
                $data['url'] = $bookmark->url;                  
                $data['date_create'] = $bookmark->date_create;       
                
                $json['status'] = 1;
                $json['items'][] = $data;                
            }  
        }    
        else
        {
            $json['status'] = 0;
            $json['message'] = 'Access denied';
        }
        $this->display_ajax(json_encode($json));
    }
            
}
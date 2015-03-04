<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_Bookmarks extends Controller_Api_Auth
{
    public $template = 'layouts/empty';
            
    /* 
     * Set the bookmarks
     * @url 
     *      /api/bookmarks/synch
     * @method
     *      POST 
     * @header
     *      X-Auth-Token: access_token
     * @params         
     *      bookmarks = json array(bookmark1, bookmark2, bookmark3...)
     *          where bookmark1..N = array(
     *                                  0=>parent_id, 
     *                                  1=>is_category
     *                                  2=>name, 
     *                                  3=>url
     *                               )
     * @return 
     *      status  = [0/1]
     *      message = 'error message';
     */
    public function action_set()
    {      
        $json = array();                
        $bookmarks = Arr::get($_POST, 'bookmarks', NULL);
        
        if (!empty($bookmarks))
        {
            // Auth user
            if ($user = $this->auth_user())
            {                
                $bookmarksArray = json_decode($bookmarks, true);                 
                $this->_add_bookmarks($bookmarksArray, 0 ,'');
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
     * List of bookmarks    
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
                $data['parent_id'] = $bookmark->parent_id;
                $data['is_category'] = $bookmark->is_category;
                $data['path'] = $bookmark->path;
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
    
    protected function _add_bookmarks($bookmarks, $parent_id, $path)
    {      
        foreach ($bookmarks as $newBookmark)
        {   
            $bmParentId = $parent_id;
            $bmIsCategory = !empty($newBookmark['children']) && is_array($newBookmark['children']);            
            $bmName = $newBookmark['title'];
            $bmUrl = $newBookmark['url'];
            if ($bmIsCategory)
            {                
                $oldBookmark = ORM::factory('Bookmarks')
                                        ->where('user_id','=',$user->id)                                        
                                        ->and_where('path','=',$path)
                                        ->and_where('name','=',$bmName)
                                        ->find();                
                if (!$oldBookmark->loaded())
                {
                    $data = array();
                    $data['user_id'] = $user->id;
                    $data['is_category'] = $bmIsCategory;
                    $data['parent_id'] = $bmParentId;
                    $data['name'] = $bmName;
                    $data['url'] = $bmUrl;  
                    $data['date_create'] = date('Y-m-d H:i:s');
                    if (!$bmIsCategory)
                    {
                        $data['path'] = $path;
                    }
                    // Save
                    $bm = ORM::factory('Bookmarks')->values($data)->save();                            
                    
                    $json['new_bookmarks'][] = $data;
                    $newId = $bm->id;
                    $newPath = $path . '/' . $bmName;
                    $this->_add_bookmarks($newBookmarks['children'], $newId, $newPath);
                }
                
            }
            elseif (!empty($bmUrl))
            {
                $oldBookmark = ORM::factory('Bookmarks')
                                        ->where('user_id','=',$user->id)
                                        ->and_where('url','=',$bmUrl)
                                        ->and_where('path','=',$path)
                                        ->find();                
                if (!$oldBookmark->loaded())
                {
                    $data = array();
                    $data['user_id'] = $user->id;
                    $data['is_category'] = $bmIsCategory;
                    $data['parent_id'] = $bmParentId;
                    $data['name'] = $bmName;
                    $data['url'] = $bmUrl;  
                    $data['date_create'] = date('Y-m-d H:i:s');
                    if (!$bmIsCategory)
                    {
                        $data['path'] = $path;
                    }
                    // Save
                    ORM::factory('Bookmarks')->values($data)->save();                            
                    $json['new_bookmarks'][] = $data;
                }
            }
            
        }        
    }    
            
}
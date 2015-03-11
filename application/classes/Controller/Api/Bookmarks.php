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
                
        // Auth user
        if ($user = $this->auth_user())
        {                
            $bookmarksArray = json_decode($bookmarks, true);                
            $json['status'] = 1;            
            $json['new_bookmarks'] = $this->_add_bookmarks($bookmarksArray, $user->id, 0, '');

        }
        else
        {
            $json['status'] = 0;
            $json['message'] = 'Access denied';
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
    
    protected function _add_bookmarks($bookmarks, $user_id, $parent_id, $path)
    {      
        $resultNewBookmarksArray = array();
        
        foreach ($bookmarks as $newBookmark)
        {               
            $bmParentId = $parent_id;
            $bmUserId = $user_id;
            $bmIsCategory = isset($newBookmark['children']) && is_array($newBookmark['children']);            
            $bmName = $newBookmark['title'];
            $bmUrl = empty($newBookmark['url']) ? '' : $newBookmark['url'];
            if ($bmIsCategory)
            {      
                var_dump($bmIsCategory);
                $oldBookmark = ORM::factory('Bookmarks')
                                        ->where('user_id','=',$bmUserId)                                                                                
                                        ->and_where('name','=',$bmName)
                                        ->and_where('path','=',$path)
                                        ->find();
                if ($oldBookmark->loaded())
                {
                    $newId = $oldBookmark->id;
                    $slash = empty($path) ? '' : '$`^;';
                    $newPath = $path . $slash . $oldBookmark->name;                    
                }
                else
                {
                    $data = array();
                    $data['user_id'] = $bmUserId;
                    $data['is_category'] = $bmIsCategory;
                    $data['parent_id'] = $bmParentId;
                    $data['name'] = $bmName;
                    $data['url'] = $bmUrl;  
                    $data['path'] = $path;
                    $data['date_create'] = date('Y-m-d H:i:s');                    
                                        
                    // Save
                    $bm = ORM::factory('Bookmarks')->values($data)->save();                            
                    
                    $resultNewBookmarksArray[] = $data;
                    $newId = $bm->id;
                    $slash = empty($path) ? '' : '$`^;';
                    $newPath = $path . $slash . $bmName;
                }                    
                $list = $this->_add_bookmarks($newBookmark['children'], $bmUserId, $newId, $newPath);
                $resultNewBookmarksArray = array_merge($resultNewBookmarksArray, $list);
            }
            elseif (!empty($bmUrl))
            {
                $oldBookmark = ORM::factory('Bookmarks')
                                        ->where('user_id','=',$bmUserId)
                                        ->and_where('url','=',$bmUrl)
                                        ->and_where('path','=',$path)
                                        ->find();                
                if (!$oldBookmark->loaded())
                {
                    $data = array();
                    $data['user_id'] = $bmUserId;
                    $data['is_category'] = $bmIsCategory;
                    $data['parent_id'] = $bmParentId;
                    $data['name'] = $bmName;
                    $data['url'] = $bmUrl;  
                    $data['path'] = $path;
                    $data['date_create'] = date('Y-m-d H:i:s');
                    
                    // Save
                    ORM::factory('Bookmarks')->values($data)->save();                            
                    $resultNewBookmarksArray[] = $data;
                }
            }
        }
        return $resultNewBookmarksArray;
    }    
            
}
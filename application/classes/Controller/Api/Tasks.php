<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_Tasks extends Controller_Api_Auth
{
    public $template = 'layouts/empty';
    
    /* 
     * Add task or category     
     * @url 
     *      /api/tasks/add
     * @method
     *      POST 
     * @header
     *      X-Auth-Token: access_token
     * @params 
     *      is_category   
     *      title
     *      text     
     *      parent_id
     *      status
     *      deadline
     * @return 
     *      status  = [0/1]
     *      message = 'error message';
     */
    public function action_add()
    {      
        $json = array();        
        
        if ($user = $this->auth_user())
        {
            $data = array();            
            $data['title']       = Arr::get($_POST, 'title', NULL);
            $data['text']        = Arr::get($_POST, 'text', NULL);            
            $data['is_category'] = Arr::get($_POST, 'is_category', 0);
            $data['parent_id']   = Arr::get($_POST, 'parent_id', 0);
            $data['deadline']    = Arr::get($_POST, 'deadline', 0);
            $data['status']      = Arr::get($_POST, 'status', '');
            
            $isCategory = $data['is_category'];

            // Validation
            $validator = Validation::factory($data);
            $validator->rule('title', 'not_empty');
            $validator->rule('parent_id', 'numeric');
            $validator->rule('user_id', 'numeric');
            if ($isCategory)
            {
                $validator->rule('text', 'not_empty');
            }

            if ($validator->check())
            {   
                $task = ORM::factory('Tasks');   
                
                $task->title = $data['title'];
                $task->user_id = $user->id;                
                $task->parent_id = $data['parent_id'];
                $task->is_category = $data['is_category'];
                $task->text = $data['text'];
                $task->status = $data['status'];            
                $task->deadline = $data['deadline']; 
                $task->date_create = time();       
                $task->date_update = time();
                $task->save();            
                $json['status'] = 1;                   
            }
            else
            {
                $json['status'] = 0;
                $json['message'] = 'Invalid field values';
            } 
        }
        else
        {
            $json['status'] = 0;
            $json['message'] = 'Access denied';
        }
        $this->display_ajax(json_encode($json));        
    }
    
    /* 
     * Update task or category     
     * @url 
     *      /api/tasks/delete
     * @method
     *      POST
     * @header
     *      X-Auth-Token: access_token
     * @params 
     *      id               
     *      title
     *      text
     *      status
     *      deadline
     * @return 
     *      status  = [0/1]
     *      message = 'error message';
     */
    public function action_update()
    {   
        $json = array();
        $id = Arr::get($_POST, 'id', NULL);
        
        if ($user = $this->auth_user())
        {        
            $data = array();
            $data['title']     = Arr::get($_POST, 'title', NULL);        
            $data['text']     = Arr::get($_POST, 'text', NULL);
            $data['status']   = Arr::get($_POST, 'status', NULL);
            $data['deadline'] = Arr::get($_POST, 'deadline', NULL);

            // Validation
            $validator = Validation::factory($data);
            $validator->rule('title','not_empty')
                      ->rule('text','not_empty')
                      ->rule('status','not_empty')
                      ->rule('deadline','not_empty');

            if ($validator->check())
            {   
                $task = ORM::factory('Tasks')
                            ->where('id','=',$id)
                            ->and_where('user_id','=',$user->id)
                            ->find();
                
                if ($task->loaded())
                {
                    $task->title = $data['title'];            
                    $task->text = $data['text'];            
                    $task->status = $data['status'];            
                    $task->deadline = $data['deadline'];         
                    $task->date_update = time();            
                    $task->save();            
                    $json['status'] = 1;
                }
                else
                {
                    $json['status'] = 0;
                    $json['message'] = 'Not found id';
                }
            }
            else
            {
                $json['status'] = 0;
                $json['message'] = 'Empty field';
            }
        }   
        else
        {
            $json['status'] = 0;
            $json['message'] = 'Access denied';
        }
        $this->display_ajax(json_encode($json));        
    }
        
    /* 
     * Delete task or category     
     * @url 
     *      /api/tasks/delete
     * @method
     *      POST
     * @header
     *      X-Auth-Token: access_token
     * @params 
     *      id 
     * @return 
     *      status  = [0/1]
     *      message = 'error message';
     */
    public function action_delete()
    {        
        $json = array();
        $id = Arr::get($_POST, 'id', NULL);
        
        if ($user = $this->auth_user())
        {         
            $task = ORM::factory('Tasks')->where('id','=',$id)->find();        
            if ($task->loaded())
            {    
                $task->delete();
                $json['status'] = 1;            
            }
        }
        else
        {
            $json['status'] = 0;
            $json['message'] = 'Access denied';
        }
        $this->display_ajax(json_encode($json));
    }
    
    /* 
     * List of tasks and category     
     * @url 
     *      /api/tasks/list
     * @method
     *      POST
     * @header
     *      X-Auth-Token: access_token
     * @params 
     *      parent_id     
     * @return 
     *      status  = [0/1]
     *      message = 'error message';
     * 
     */     
    public function action_list()
    {
        $json = array();
        $json['items'] = array();
        
        $parent_id = Arr::get($_POST, 'parent_id', 0);        
        
        if ($user = $this->auth_user())
        {   
            $tasks = ORM::factory('Tasks')
                        ->where('parent_id','=',$parent_id)
                        ->and_where('user_id','=',$task->user_id)
                        ->find_all();
            
            foreach ($tasks as $task)
            {
                $data = array();                
                $data['id'] = $task->id;
                $data['user_id'] = $task->user_id;
                $data['title'] = $task->title;
                $data['text'] = $task->text;  
                $data['is_category'] = $task->is_category;
                $data['parent_id'] = $task->parent_id;
                $data['status'] = $task->status;
                $data['deadline'] = $task->deadline; 
                $data['date_create'] = $task->date_create;       
                $data['date_update'] = $task->date_update;
                
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
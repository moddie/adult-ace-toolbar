<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_Tasks extends Controller_Api_Auth
{
    public $template = 'layouts/empty';
    
    /* 
     * Add or Update task or category     
     * @url 
     *      /api/tasks/add
     * @method
     *      POST 
     * @header
     *      X-Auth-Token: access_token
     * @params 
     *      id - (only for update)
     *      is_category        
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
        $id = Arr::get($_POST, 'id', NULL);
        
        if ($user = $this->auth_user())
        {
            $data = array();                        
            $data['text']        = Arr::get($_POST, 'text', NULL);            
            $data['is_category'] = Arr::get($_POST, 'is_category', 0);
            $data['parent_id']   = Arr::get($_POST, 'parent_id', 0);
            $data['deadline']    = Arr::get($_POST, 'deadline', NULL);
            $data['status']      = Arr::get($_POST, 'status', '');
            
            // Validation
            $validator = Validation::factory($data);
            $validator->rule('text', 'not_empty');
            $validator->rule('parent_id', 'numeric');

            if ($validator->check())
            {   
                $save = false;
                if ($data['parent_id'] != 0)
                {
                    $parent = ORM::factory('Tasks')->where('id','=',$data['parent_id'])->find();
                    if ($parent->loaded()) {
                        if ($parent->is_category) 
                        {
                            $save = true;
                        }
                    }                    
                }
                else 
                {
                    $save = true;
                }                    
                // Save to database
                if ($save)
                {
                    if ($id)
                    { 
                        //-----------------------------------
                        // Update task
                        //-------------
                        $task = ORM::factory('Tasks')
                                ->where('id','=',$id)
                                ->and_where('user_id','=',$user->id)
                                ->find();
                        if ($task->loaded())
                        {
                            if( !empty($data['parent_id']) )
                            {
                                $task->parent_id = $data['parent_id'];
                            }
                            if( !empty($data['order']) )
                            {
                                $task->order = $data['order'];
                            }
                            if( !empty($data['status']) )
                            {
                                $task->status = $data['status'];
                            }                        
                            if( !empty($data['deadline']) )
                            {                                   
                                if ($deadline = strtotime($data['deadline']))
                                {
                                    $task->deadline = $deadline;
                                }
                                else
                                {
                                    $json['message'] = 'Wrong date format';
                                }
                            }
                            if( !empty($data['text']) )
                            {
                                $task->text = $data['text'];
                            }
                            $task->date_update = time();
                            $task->save();
                            $json['task_id'] = $task->id;
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
                        //-----------------------------------
                        // Add task
                        //----------
                        
                        // Get order
                        $lastTask = ORM::factory('Tasks')
                                    ->where('parent_id','=',$data['parent_id'])
                                    ->order_by('order','DESC')
                                    ->limit(1)
                                    ->find();
                        if ($lastTask->loaded())
                        {
                            $order = intval($lastTask->order) + 1;
                        }
                        else
                        {
                            $order = 1;
                        }                        
                        // Save
                        $task = ORM::factory('Tasks');
                        
                        $task->user_id = $user->id;                
                        $task->parent_id = $data['parent_id'];
                        $task->is_category = $data['is_category'];
                        $task->order = $order;
                        $task->text = $data['text'];
                        $task->status = $data['status'];            
                        $task->deadline = $data['deadline']; 
                        $task->date_create = time();       
                        $task->date_update = time();
                        $task->save();
                        
                        $json['status'] = 1;
                        $json['task_id'] = $task->id;
                        $json['order'] = $order;
                    }
                }
                else
                {
                    $json['status'] = 0;
                    $json['message'] = 'You can not add task to category of parent_id=' . $data['parent_id'];
                }
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
            if ($id !== NULL)
            {
                $this->_delete($id, $user->id);      
                $json['status'] = 1;
            }   
            else
            {
                $json['status'] = 0;
                $json['message'] = 'Empty id';
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
     * Change orders
     * @url 
     *      /api/tasks/reorder
     * @method
     *      POST
     * @header
     *      X-Auth-Token: access_token
     * @params 
     *      orders = array(
     *                  id => order
     *               )
     * @return 
     *      status  = [0/1]
     *      message = 'error message';
     */
    public function action_reorder()
    {        
        $json = array();
        $orders = Arr::get($_POST, 'orders', array());
        
        if ($user = $this->auth_user())
        {
            $amount = 0;
            foreach ($orders as $id=>$order)
            {
                $task = ORM::factory('Tasks')->where('id','=',$id)->find();        
                if ($task->loaded())
                {    
                    $task->order = $order;
                    $task->save();                        
                    $amount++;
                }
            }
            $json['status'] = 1;
            $json['amount_of_change'] = $amount;
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
     *      items   = array(
     *                  parent_id => array of tasks and categories
     *                )
     *      status  = [0/1]
     *      message = 'error message';
     * 
     */     
    public function action_list()
    {
        $json = array();        
        
        $parent_id = Arr::get($_POST, 'parent_id', 0);        
        
        if ($user = $this->auth_user())
        {   
            $items = array();            
            $this->_get_tasks_of_parent_id($items, $parent_id, $user->id);
            
            $json['items'] = $items;            
            $json['status'] = 1;             
        }    
        else
        {
            $json['status'] = 0;
            $json['message'] = 'Access denied';
        }
        $this->display_ajax(json_encode($json));        
    }
    
    /*----------------------------------------------------------------------
     * Protected functions
     */
    
    protected function _get_tasks_of_parent_id(&$arr, $parent_id, $user_id)
    {
        $categories = array();
        $tasks = ORM::factory('Tasks')
                        ->where('parent_id','=',$parent_id)
                        ->and_where('user_id','=',$user_id)
                        ->order_by('order','ASC')                        
                        ->find_all();              
        foreach ($tasks as $task)
        {
            $data = array();
            $data['id'] = $task->id;
            $data['user_id'] = $task->user_id;            
            $data['parent_id'] = $task->parent_id;
            $data['is_category'] = $task->is_category;
            $data['order'] = $task->order;            
            $data['text'] = $task->text;
            $data['status'] = $task->status;
            $data['deadline'] = $task->deadline;
            $data['date_create'] = $task->date_create;
            $data['date_update'] = $task->date_update;
            
            //return
            $arr[$parent_id][] = $data;
            
            if ($task->is_category)
            {
                $categories[] = $task->id;
            }
        }
        //subcategories
        foreach ($categories as $parentId)
        {
            $this->_get_tasks_of_parent_id($arr, $parentId, $user_id);
        }
    }    
    
    protected function _delete($id, $user_id)
    {
        $task = ORM::factory('Tasks')
                        ->where('id','=',$id)
                        ->and_where('user_id','=',$user_id)
                        ->find();
        if ($task->loaded())
        {
            if ($task->is_category)
            {
                $subTasks = ORM::factory('Tasks')->where('parent_id','=',$id)->find_all();                
                foreach ($subTasks as $sub)
                {
                    $this->_delete($sub->id, $user_id);
                }
            }
            $task->delete();
        }
    }    
        
}
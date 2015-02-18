<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_Tasks extends Controller_Base
{
    public $template = 'layouts/empty';
    
    public function action_add()
    {      
        $json = array();
        $isCategory = Arr::get($_POST, 'is_category', false);
        
        $data = array();
        $data['title']     = Arr::get($_POST, 'title', NULL);
        $data['user_id']   = Arr::get($_POST, 'user_id', NULL);
        $data['parent_id'] = Arr::get($_POST, 'parent_id', 0);
        $data['deadline']  = Arr::get($_POST, 'deadline', 0);
        $data['status']    = Arr::get($_POST, 'status', '');
        
        // Validation
        $validator = Validation::factory($data);
        $validator->rule('title', 'not_empty');
        $validator->rule('parent_id', 'numeric');                
        if ($isCategory)
        {
            $validator->rule('text', 'not_empty');
        }
        
        if ($validator->check())
        {         
            $task = ORM::factory('Tasks');    
            
            $task->title = $data['title'];
            $task->user_id = $data['user_id'];
            $task->parent_id = $data['parent_id'];
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
        $this->display_ajax(json_encode($json));        
    }
    
    
    public function action_update()
    {   
        $json = array();
        $id = Arr::get($_POST, 'id', NULL);
        
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
            $task = ORM::factory('Tasks', $id);
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
        $this->display_ajax(json_encode($json));        
    }
        
    
    public function action_delete()
    {           
        $id = Arr::get($_GET, 'id', NULL);
        
        $task = ORM::factory('Tasks')->where('id','=',$id)->find();        
        if ($task->loaded())
        {    
            $task->delete();
            $json['status'] = 1;            
        }
    }
    
}
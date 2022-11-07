<?php

namespace App\Repository;

use App\Models\ProjectDetails;
use App\Models\task_list;
use App\Models\User;
use App\Repository\Interfaces\TaskListInterface;

class TaskListRepository implements TaskListInterface
{
    public function add_task(array $attributes)
    {
        $task = new task_list();
        $task->title = $attributes['title'];
        $task->description = $attributes['description'];
        $task->status = $attributes['status'];
        $task->project_id = $attributes['project_id'];
        $task->user_id = $attributes['user_id'];
        $result = $task->save();
        return $result;
    }
    public function get_task_by_id(array $attributes){
        $task = task_list::where('project_id', data_get($attributes, 'project_id'))->where('user_id', data_get($attributes, 'user_id'))->get();
        if (count($task) > 0 ) {
            $arr = array();
            for($i=0;isset($task[$i]['project_id']);$i++){
                $get_task = $task[$i]['project_id'];
                $find_task = task_list::where('id', $get_task)->get();
                array_unshift($arr,$find_task);
            }
            return $task;
        }
    }

}

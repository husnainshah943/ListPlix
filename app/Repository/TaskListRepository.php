<?php

namespace App\Repository;

use App\Models\ProjectDetails;
use App\Models\taskList;
use App\Models\User;
use App\Repository\Interfaces\TaskListInterface;
use function GuzzleHttp\Promise\task;

class TaskListRepository implements TaskListInterface
{
    public function add_task($attributes)
    {
        $task = new TaskList();
        $task->title = $attributes['title'];
        $task->description = $attributes['description'];
        $task->status = $attributes['status'];
        $task->project_id = $attributes['project_id'];
        $task->user_id = $attributes['user_id'];
        $result = $task->save();
        return $result;
    }
    public function get_project_tasks_by_userid($attributes){
        $task = TaskList::where('project_id', $attributes['project_id'])->where('user_id', $attributes['user_id'])->get();
        if (count($task) > 0 ) {
            $arr = array();
            for($i=0;isset($task[$i]['project_id']);$i++){
                $get_task = $task[$i]['project_id'];
                $find_task = TaskList::where('id', $get_task)->get();
                array_unshift($arr,$find_task);
            }
            return $task;
        }
    }
    public function get_task($id)
    {
       $result = TaskList::where('project_id', $id)->get();
       return $result;
    }

    public function update_task_status($attributes)
    {
        $respone = TaskList::where('id', $attributes['id'])->get();
        if($respone) {
            $respone->status = $attributes['status'];
            $result = $respone->update();
            return $result;
        }else{
            return false;
        }
    }
}

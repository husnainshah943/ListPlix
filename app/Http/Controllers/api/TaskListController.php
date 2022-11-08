<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProjectRequests;
use App\Http\Requests\AddTaskRequests;
use App\Http\Requests\GetTaskRequests;
use App\Repository\Interfaces\ProjectInterface;
use App\Repository\Interfaces\TaskListInterface;
use Illuminate\Http\Request;

class TaskListController extends Controller
{
    private $tasklist_repository;
    public function __construct(TaskListInterface $tasklist_repository)
    {
        $this->tasklist_repository = $tasklist_repository;
    }
    public function add_task(AddTaskRequests $request){
        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'project_id' => $request->input('project_id'),
            'user_id' => $request->input('user_id'),
        ];
        $result = $this->tasklist_repository->add_task($data);
        if ($result){
            return response()->json(['message' => 'Task Created'], 200);
        }else{
            return response()->json(['error' => 'Unable to create task'], 401);
        }
    }
    public function get_task_by_id(GetTaskRequests $request)
    {
        $data = [
            'project_id' => $request->input('project_id'),
            'user_id' => $request->input('user_id'),
        ];
        $result = $this->tasklist_repository->get_task_by_id($data);
        if (!$result) {
            return response()->json(['error' => 'task not found.'], 401);
        } else {
            return response()->json(['task' => $result],200);
        }
    }
    public function get_task($id)
    {
        $result = $this->tasklist_repository->get_task($id);
        if (!$result) {
            return response()->json(['error' => 'task not found.'], 401);
        } else {
            return response()->json(['task' => $result],200);
        }
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequests\AddTaskRequest;
use App\Http\Requests\TaskRequests\GetTaskRequest;
use App\Repository\Interfaces\TaskListInterface;

class TaskListController extends Controller
{
    private $tasklist_repository;
    public function __construct(TaskListInterface $tasklist_repository)
    {
        $this->tasklist_repository = $tasklist_repository;
    }
    public function add_task(AddTaskRequest $request){

        $response = $this->tasklist_repository->add_task($request->all());
        if ($response){
            return response()->json(['message' => 'Task Created'], 200);
        }else{
            return response()->json(['error' => 'Unable to create task'], 401);
        }
    }
    public function get_project_tasks_by_userid(GetTaskRequest $request)
    {
        $response = $this->tasklist_repository->get_project_tasks_by_userid($request->all());
        if (!$response) {
            return response()->json(['error' => 'task not found.'], 401);
        } else {
            return response()->json(['task' => $response],200);
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

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequests\AddTaskRequest;
use App\Http\Requests\TaskRequests\GetTaskRequest;
use App\Http\Requests\TaskRequests\TaskStatusUpdateRequest;
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
        $response = $this->tasklist_repository->get_task($id);
        if (!$response) {
            return response()->json(['error' => 'task not found.'], 401);
        } else {
            return response()->json(['task' => $response],200);
        }
    }
    public function update_task_status(TaskStatusUpdateRequest $request)
    {
        $response = $this->tasklist_repository->get_task($request);
        if (!$response) {
            return response()->json(['error' => 'Unable to update the task.'], 401);
        } else {
            return response()->json(['message' => 'Task Updated Successfully.'],200);
        }
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
use App\Http\Requests\AddProjectRequests;
use App\Http\Requests\AddTaskRequests;
use App\Http\Requests\GetTaskRequests;
use App\Repository\Interfaces\ProjectInterface;
use App\Repository\Interfaces\TaskListInterface;
use Illuminate\Http\Request;
=======
use App\Http\Requests\TaskRequests\AddTaskRequest;
use App\Http\Requests\TaskRequests\GetTaskRequest;
use App\Http\Requests\TaskRequests\TaskStatusUpdateRequest;
use App\Repository\Interfaces\TaskListInterface;
>>>>>>> e8082a1 (ListPlix Completed - RestApis)

class TaskListController extends Controller
{
    private $tasklist_repository;
    public function __construct(TaskListInterface $tasklist_repository)
    {
        $this->tasklist_repository = $tasklist_repository;
    }
<<<<<<< HEAD
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
=======
    public function add_task(AddTaskRequest $request){

        $response = $this->tasklist_repository->add_task($request->all());
        if ($response){
>>>>>>> e8082a1 (ListPlix Completed - RestApis)
            return response()->json(['message' => 'Task Created'], 200);
        }else{
            return response()->json(['error' => 'Unable to create task'], 401);
        }
    }
<<<<<<< HEAD
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
=======
    public function get_project_tasks_by_userid(GetTaskRequest $request)
    {
        $response = $this->tasklist_repository->get_project_tasks_by_userid($request->all());
        if (!$response) {
            return response()->json(['error' => 'task not found.'], 401);
        } else {
            return response()->json(['task' => $response],200);
>>>>>>> e8082a1 (ListPlix Completed - RestApis)
        }
    }
    public function get_task($id)
    {
<<<<<<< HEAD
        $result = $this->tasklist_repository->get_task($id);
        if (!$result) {
            return response()->json(['error' => 'task not found.'], 401);
        } else {
            return response()->json(['task' => $result],200);
=======
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
>>>>>>> e8082a1 (ListPlix Completed - RestApis)
        }
    }
}

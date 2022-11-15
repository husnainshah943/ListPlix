<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
use App\Http\Requests\AddProjectRequests;
use App\Http\Requests\EditProjectRequests;
use App\Http\Requests\GetProjectRequests;
use App\Http\Requests\UpdateProjectRequests;
use App\Repository\Interfaces\ProjectInterface;
use Illuminate\Http\Request;
=======
use App\Http\Requests\ProjectRequests\AddProjectRequest;
use App\Http\Requests\ProjectRequests\GetProjectRequest;
use App\Http\Requests\ProjectRequests\UpdateProjectRequest;
use App\Repository\Interfaces\ProjectInterface;
>>>>>>> e8082a1 (ListPlix Completed - RestApis)

class ProjectController extends Controller
{
    private $project_repository;
    public function __construct(ProjectInterface $project_repository)
    {
        $this->project_repository = $project_repository;
    }
<<<<<<< HEAD
    public function add_project(AddProjectRequests $request)
    {
        $data = [
            'project_title' => $request->input('project_title'),
            'project_description' => $request->input('project_description'),
            'user_id' => $request->input('user_id'),
        ];
        $result = $this->project_repository->add_project($data);
        if ($result) {
            return response()->json(['message' => 'Project Created'], 200);
        } else {
            return response()->json(['message' => 'Unable to create project'], 401);
=======
    public function add_project(AddProjectRequest $request)
    {
        $response = $this->project_repository->add_project($request->all());
        if ($response) {
            return response()->json(['message' => 'Project Created'], 200);
        } else {
            return response()->json(['error' => 'Unable to create project'], 401);
>>>>>>> e8082a1 (ListPlix Completed - RestApis)
        }
    }
    public function all_projects()
    {
<<<<<<< HEAD
        $projects = $this->project_repository->all_projects();
        if ($projects != null) {
            return response()->json(['message' => $projects], 200);
=======
        $response = $this->project_repository->all_projects();
        if ($response != null) {
            return response()->json(['projects' => $response], 200);
>>>>>>> e8082a1 (ListPlix Completed - RestApis)
        } else {
            return response()->json(['error' => 'project not found.'], 401);
        }
    }
<<<<<<< HEAD
    public function project_by_id(GetProjectRequests $request)
    {
         $data = $request->input('user_id');
         $projects = $this->project_repository->project_by_id($data);
         if (!$projects) {
             return response()->json(['error' => 'Project not found.'], 401);
         } else {
             return response()->json(['message' => $projects],200);
         }
    }
    public function edit_project($id){
//        $data = $request->input('project_id');
        $project = $this->project_repository->edit_project($id);
        if (!$project) {
            return response()->json(['error' => 'Project not found.'], 401);
        } else {
            return response()->json(['message' => $project],200);
        }
    }
    public function update_project(UpdateProjectRequests $request){
        $data = [
            'project_id' => $request->input('project_id'),
            'project_title' => $request->input('project_title'),
            'project_description' => $request->input('project_description'),
        ];
        $project = $this->project_repository->update_project($data);
        if (!$project) {
=======
    public function project_by_userid(GetProjectRequest $request)
    {
        $response = $this->project_repository->project_by_userid($request->all());
         if (!$response) {
             return response()->json(['error' => 'Project not found.'], 401);
         } else {
             return response()->json(['projects' => $response],200);
         }
    }
    public function edit_project($id){
        $response = $this->project_repository->edit_project($id);
        if (!$response) {
            return response()->json(['error' => 'Project not found.'], 401);
        } else {
            return response()->json(['projects' => $response],200);
        }
    }
    public function update_project(UpdateProjectRequest $request){
        $response = $this->project_repository->update_project($request->all());
        if (!$response) {
>>>>>>> e8082a1 (ListPlix Completed - RestApis)
            return response()->json(['error' => 'Error updating the project.'], 401);
        } else {
            return response()->json(['message' => 'Project updated successfully.'],200);
        }
    }
    public function delete_project($id){
<<<<<<< HEAD
//        $data = $request->input('project_id');
        $project = $this->project_repository->delete_project($id);
        if (!$project) {
=======
        $response = $this->project_repository->delete_project($id);
        if (!$response) {
>>>>>>> e8082a1 (ListPlix Completed - RestApis)
            return response()->json(['error' => 'Project not found.'], 401);
        } else {
            return response()->json(['message' => 'Project deleted successfully.'],200);
        }
    }
}

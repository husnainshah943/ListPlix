<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequests\AddProjectRequest;
use App\Http\Requests\ProjectRequests\GetProjectRequest;
use App\Http\Requests\ProjectRequests\UpdateProjectRequest;
use App\Repository\Interfaces\ProjectInterface;

class ProjectController extends Controller
{
    private $project_repository;
    public function __construct(ProjectInterface $project_repository)
    {
        $this->project_repository = $project_repository;
    }
    public function add_project(AddProjectRequest $request)
    {
        $response = $this->project_repository->add_project($request->all());
        if ($response) {
            return response()->json(['message' => 'Project Created'], 200);
        } else {
            return response()->json(['error' => 'Unable to create project'], 401);
        }
    }
    public function all_projects()
    {
        $response = $this->project_repository->all_projects();
        if ($response != null) {
            return response()->json(['projects' => $response], 200);
        } else {
            return response()->json(['error' => 'project not found.'], 401);
        }
    }
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
            return response()->json(['error' => 'Error updating the project.'], 401);
        } else {
            return response()->json(['message' => 'Project updated successfully.'],200);
        }
    }
    public function delete_project($id){
        $response = $this->project_repository->delete_project($id);
        if (!$response) {
            return response()->json(['error' => 'Project not found.'], 401);
        } else {
            return response()->json(['message' => 'Project deleted successfully.'],200);
        }
    }
}

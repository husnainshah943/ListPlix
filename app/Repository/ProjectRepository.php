<?php

namespace App\Repository;

use App\Models\assignTo;
use App\Models\ProjectDetails;
use App\Models\taskList;
use App\Models\User;
use App\Repository\Interfaces\ProjectInterface;

class ProjectRepository implements ProjectInterface
{
    private $error,$message;
    public function add_project($attributes)
    {
        $project = new ProjectDetails();
        $project->project_title = $attributes['project_title'];
        $project->project_description = $attributes['project_description'];
        $project->save();

        $get_id = ProjectDetails::where('project_title', $attributes['project_title'])->get();
        $check = $get_id[0]['id'];
        $assign = new assignTo();
        $assign->project_id = $check;
        $assign->user_id = $attributes['user_id'];;
        $result = $assign->save();
        return $result;
    }
    public function all_projects()
    {
        $projects = ProjectDetails::all();
        return $projects;
    }
    public function find_project($id)
    {
        $project = ProjectDetails::find($id);
        return $project;
    }
    public function project_by_userid($id)
    {
        $project = AssignTo::where('user_id',$id)->get();
        if (count($project) > 0) {
            $arr = array();
            for($i=0;isset($project[$i]['project_id']);$i++){
                $get_project = $project[$i]['project_id'];
                $find_project = ProjectDetails::where('id', $get_project)->get();
                array_unshift($arr,$find_project);
            }
            return $arr;
        } else {
            return false;
        }
    }
    public function edit_project($id)
    {
        $project = $this->find_project($id);
        if ($project){
            return $project;
        }else{
            return false;
        }
    }
    public function update_project($attributes)
    {
        $project = $this->find_project($attributes['project_id']);
        if($project) {
            $project->project_title = $attributes['project_title'];
            $project->project_description = $attributes['project_description'];
            $result = $project->update();
            return $result;
        }else{
            return false;
        }
    }
    public function delete_project($id)
    {
        $result = TaskList::where('project_id', $id)->delete();
        $result = AssignTo::where('project_id', $id)->delete();
        $result = ProjectDetails::where('id', $id)->delete();

        return $result;
    }
}

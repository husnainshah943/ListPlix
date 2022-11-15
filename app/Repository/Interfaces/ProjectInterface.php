<?php

namespace App\Repository\Interfaces;

interface ProjectInterface
{
<<<<<<< HEAD
    public function add_project(array $attributes);
    public function all_projects();
    public function find_project($id);
    public function project_by_id($id);
    public function edit_project($id);
    public function update_project(array $attributes);
=======
    public function add_project($attributes);
    public function all_projects();
    public function find_project($id);
    public function project_by_userid($id);
    public function edit_project($id);
    public function update_project($attributes);
>>>>>>> e8082a1 (ListPlix Completed - RestApis)
    public function delete_project($id);
}

<?php

namespace App\Repository\Interfaces;

interface ProjectInterface
{
    public function add_project(array $attributes);
    public function all_projects();
    public function find_project($id);
    public function project_by_userid($id);
    public function edit_project($id);
    public function update_project(array $attributes);
    public function delete_project($id);
}

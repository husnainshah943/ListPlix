<?php

namespace App\Repository\Interfaces;

interface TaskListInterface
{
    public function add_task(array $attributes);
    public function get_project_tasks_by_userid(array $attributes);
    //web
    public function get_task($id);
}

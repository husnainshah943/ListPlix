<?php

namespace App\Repository\Interfaces;

interface TaskListInterface
{
    public function add_task($attributes);
    public function get_project_tasks_by_userid($attributes);

    /**
     * @function for admin panel - web
     */
    public function get_task($id);
    public function update_task_status($attributes);
}

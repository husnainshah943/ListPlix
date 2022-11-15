<?php

namespace App\Repository\Interfaces;

interface TaskListInterface
{
<<<<<<< HEAD
    public function add_task(array $attributes);
    public function get_task_by_id(array $attributes);
    //web
    public function get_task($id);
=======
    public function add_task($attributes);
    public function get_project_tasks_by_userid($attributes);

    /**
     * @function for admin panel - web
     */
    public function get_task($id);
    public function update_task_status($attributes);
>>>>>>> e8082a1 (ListPlix Completed - RestApis)
}

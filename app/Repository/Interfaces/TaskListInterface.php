<?php

namespace App\Repository\Interfaces;

interface TaskListInterface
{
    public function add_task(array $attributes);
    public function get_task_by_id(array $attributes);
}

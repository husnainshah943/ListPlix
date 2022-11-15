<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    use HasFactory;
    protected $table = "task_lists";
    protected $primaryKey = "id";
    protected $fillable =[
        'title',
        'description',
        'status',
        'project_id',
        'user_id',
    ];
}

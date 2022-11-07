<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectDetails extends Model
{
    use HasFactory;
    protected $table = "project_details";
    protected $primaryKey = "id";
    protected $fillable =[
        'project_title',
        'project_description',
    ];
}

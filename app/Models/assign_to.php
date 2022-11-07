<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assign_to extends Model
{
    use HasFactory;
    protected $table = "assign_tos";
    protected $primaryKey = "id";
    protected $fillable =[
        'project_id',
        'user_id',
    ];
}

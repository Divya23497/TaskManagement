<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskHistory extends Model
{
    use HasFactory;
    protected $table = 'task_history';

     protected $fillable = ['id','task_id', 'task_status','created_by','updated_by','status'];
}

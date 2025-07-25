<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['id','task_name', 'task_type', 'start_date','end_date','task_desc', 'task_status','approval_status','assigned_to','completion_time','created_by','updated_by','status'];

}

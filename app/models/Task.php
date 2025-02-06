<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = "tasks_data_d";

    public static function getTaskId()
    {
        return Task::select('*')->get();
    }
}
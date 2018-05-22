<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TaskLog extends Model
{
    protected $fillable = ['task_id', 'carried_out_by', 'action'];

    public function task(){
        return $this->belongsTo(Task::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'carried_out_by', 'id');
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'description', 'title', 'start_at', 'end_at', 'assigned_to', 'category_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_task');
    }
}

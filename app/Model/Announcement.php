<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['subject', 'message', 'user_id'];

    protected $table = 'announcements';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

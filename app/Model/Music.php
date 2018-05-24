<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Music extends Model
{
    use SoftDeletes;
    protected $fillable= ['link', 'file_name','format', 'duration', 
                            'release_date', 'published', 
                            'size','user_id','music_title', 'artist_id'
                         ];
    protected $music = '/music/';

    protected $dates = ['deleted_at'];

    public function genre(){
        return $this->belongsTo(Genre::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function artist(){
        return $this->belongsTo(Artist::class);
    }

    public function album(){
        return $this->belongsTo(Album::class);
    }

    public function likes(){
        return $this->hasMany(MusicReaction::class);
    }

    public function delete(){
        if(file_exists(public_path().$this->music.$this->file_name)){
            @unlink(public_path().$this->music.$this->file_name);
        }
        parent::delete();
    }

}

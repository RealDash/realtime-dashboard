<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable = ['artist_name', 'avatar'];

    protected $artists = '/artists/img/';

    public function delete(){
        if(file_exists(public_path().$this->artists.$this->avatar)){
            @unlink(public_path().$this->artists.$this->avatar);
        }
        parent::delete();
    }

    public function music(){
        return $this->hasMany(Music::class);
    }

    
}

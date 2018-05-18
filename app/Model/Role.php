<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{


    public function hasRole($role)
    {
        return $this->title == $role;
    }
}

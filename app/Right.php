<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Right extends Model
{

    public function UserRight()
    {
        return $this->belongsToMany(User::class);
    }

}

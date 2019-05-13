<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRight extends Model
{
    protected $fillable = ['role_id', 'user_id'];

    public function rights()
    {
        return $this->hasOne(Right::class);
    }

    public function users()
    {
        return $this->hasOne(User::class);
    }
}

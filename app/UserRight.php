<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRight extends Model
{
    protected $fillable = ['right_id', 'user_id'];

    public function Right()
    {
        return $this->belongsTo(UserRight::class);
    }
}

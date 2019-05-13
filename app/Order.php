<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'item_id', 'amount', 'is_picked_up'];

    public function users()
    {
        return $this->hasOne(User::class);
    }
}

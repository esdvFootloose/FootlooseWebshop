<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemRequest extends Model
{
    protected $fillable = ['user_id', 'item_id'];

    public function stocks() {
        return $this->hasOne(Stock::class);
    }

    public function users() {
        return $this->hasOne(User::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemRequest extends Model
{
    protected $fillable = ['user_id', 'stock_id'];

    public function Item()
    {
        return $this->belongsTo(Item::class);
    }

    public function Stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}


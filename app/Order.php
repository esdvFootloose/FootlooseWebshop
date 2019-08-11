<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'is_paid', 'is_picked_up'];

    public function OrderedItem()
    {
        return $this->hasMany(OrderedItem::class);
    }
}

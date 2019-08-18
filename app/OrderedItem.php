<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderedItem extends Model
{
    protected $fillable = ['order_id', 'stock_id', 'is_picked_up', 'amount'];

    public function Order()
    {
        return $this->belongsTo(Order::class);
    }

    public function Stock()
    {
        return $this->belongsTo(Stock::class);
    }
}

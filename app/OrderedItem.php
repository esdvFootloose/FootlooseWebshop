<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderedItem extends Model
{
    protected $fillable = ['order_id', 'size_id', 'amount'];
//    protected $fillable = ['order_id', 'size_id', 'item_id', 'amount'];

    public function Order()
    {
        return $this->belongsTo(Order::class);
    }

    public function Size()
    {
        return $this->belongsTo(Stock::class);
    }

    // TODO: Check if necessary
//    public function Item()
//    {
//        return $this->belongsTo(Item::class);
//    }
}

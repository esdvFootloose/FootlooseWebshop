<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Stock extends Model
{

    protected $fillable = ['item_id', 'size', 'amount'];

    public function Item()
    {
        return $this->belongsTo(Item::class);
    }

    public function OrderedItem()
    {
        return $this->hasMany(OrderedItem::class);
    }

    public function ItemRequest()
    {
        return $this->hasMany(ItemRequest::class);
    }
}

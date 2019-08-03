<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Item extends Model
{
    use HasSlug;

    protected $fillable = ['name', 'price', 'description', 'gender', 'slug', 'available_from', 'available_to'];

    public function OrderedItem()
    {
        return $this->hasMany(OrderedItem::class);
    }

    public function Stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function getSlugOptions(): SlugOptions
    {
         return SlugOptions::create()
             ->generateSlugsFrom(['name', 'gender'])
             ->saveSlugsTo('slug');
    }

    // TODO Check if necessary
//    public function ItemRequest()
//    {
//        return $this->hasMany(ItemRequest::class);
//    }
}

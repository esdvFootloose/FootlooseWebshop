<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Item extends Model implements HasMedia
{
    use HasSlug;
    use HasMediaTrait;


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

    public function registerMediaCollections()
    {
        $this->addMediaCollection('product')
            ->singleFile();
    }

}

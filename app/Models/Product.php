<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name', 'description', 'price','slug'];

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_items')
            ->withPivot('unit_price');
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product_images');
    }

    public function getImages()
    {
        return  $this->getMedia('product_images')->isNotEmpty()
            ? $this->getMedia('product_images')->map(fn($media) => $media->getUrl())->toArray()
            : [];
    }

}

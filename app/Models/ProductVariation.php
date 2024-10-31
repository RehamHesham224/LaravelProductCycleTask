<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ProductVariation extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['product_id', 'sku'];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_variation_attributes', 'variation_id', 'attribute_id')
            ->withPivot('attribute_value_id');
    }

    public function getImage()
    {
        return $this->getMedia('variation_images');
    }
    public function getImageUrl()
    {
        return $this->getFirstMediaUrl('variation_images') ?: '';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('variation_images');
    }

}

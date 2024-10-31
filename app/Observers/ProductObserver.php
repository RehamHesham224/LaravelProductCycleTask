<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Str;

class ProductObserver
{
    public function creating(Product $product)
    {
        $product->slug = Str::slug($product->name);
    }

    public function updating(Product $product)
    {
        $product->slug = Str::slug($product->name);
    }
}

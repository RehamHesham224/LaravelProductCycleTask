<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductService
{

    public function createProduct(array $data)
    {
        DB::beginTransaction();

        try {
            $product = Product::create($data);
            $this->createVariations($data['variations'], $product);
            if(isset($data['images'])) {
                $data['images'] && uploadMedia('product_images', $data['images'], $product);
            }
            DB::commit();
            return $product->load('variations', 'media');
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    private function createVariations($variations, $product){
        foreach ($variations as $variationData) {
            $variation = $product->variations()->create([
                'sku' => $variationData['sku'],
            ]);
            $this->attachAttributesToVariation($variationData, $variation);
            if(isset($variationData['image'])){
                $variationData['image'] && uploadMedia('variation_images', $variationData['image'], $variation);
            }
        }
    }

    private function attachAttributesToVariation($variationData,$variation){
        if (isset($variationData['attributes']) && is_array($variationData['attributes'])) {
            foreach ($variationData['attributes'] as $attribute) {
                $variation->attributes()->attach($attribute['id'], ['attribute_value_id' => $attribute['value_id']]);
            }
        }
    }

}

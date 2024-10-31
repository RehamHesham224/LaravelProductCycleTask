<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Support\Actions\DateAction;
use App\Support\Api\WithPagination;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Product
 */
class ProductVariationResource extends JsonResource
{
    use WithPagination;

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'price' => $this->price,
            'image' => $this->getFirstMediaUrl('variation_images') ,
            'attributes' => AttributeResource::collection($this->attributes),
        ];
    }
}

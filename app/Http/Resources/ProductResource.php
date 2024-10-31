<?php

namespace App\Http\Resources;

use App\Models\Product;
use App\Support\Actions\DateAction;
use App\Support\Api\WithPagination;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Product
 */
class ProductResource extends JsonResource
{
    use WithPagination;

    public function toArray($request)
    {
        return [
//           'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'images' => $this->getImages(),
            'variations' => ProductVariationResource::collection($this->whenLoaded('variations')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

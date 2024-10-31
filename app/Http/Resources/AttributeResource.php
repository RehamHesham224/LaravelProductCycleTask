<?php

namespace App\Http\Resources;

use App\Models\AttributeValue;
use App\Models\Product;
use App\Support\Api\WithPagination;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Product
 */
class AttributeResource extends JsonResource
{
    use WithPagination;

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'value' => $this->pivot->attribute_value_id
                ? AttributeValue::find($this->pivot->attribute_value_id)->value
                : null,
        ];
    }
}

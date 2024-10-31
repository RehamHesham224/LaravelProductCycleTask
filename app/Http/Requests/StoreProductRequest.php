<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required','string','max:255',Rule::unique('products', 'name')],
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'images' => 'sometimes|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:2048',

            // Variations validation
            'variations' => 'sometimes|array',
            'variations.*.sku' => ['nullable','string','max:255',Rule::unique('product_variations', 'sku')],

            // Single image for each variation
            'variations.*.image' => 'sometimes|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:2048',

            // Attributes for variations
            'variations.*.attributes' => 'sometimes|array',
            'variations.*.attributes.*.id' => 'required|integer|exists:attributes,id',
            'variations.*.attributes.*.value_id' => 'required|integer|exists:attribute_values,id',
        ];
    }

    /**
     * Customize the validation error messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required.',
            'price.required' => 'Product price is required.',
            'price.numeric' => 'The price must be a valid number.',
            'images.*.image' => 'Each image must be a valid image file.',
            'variations.*.image.image' => 'Each variation image must be a valid image file.',
            'variations.*.attributes.*.id.exists' => 'The selected attribute does not exist.',
            'variations.*.attributes.*.value_id.exists' => 'The selected attribute value does not exist.',
        ];
    }
}

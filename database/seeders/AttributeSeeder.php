<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colorAttribute = Attribute::firstOrCreate(['name' => 'Color']);
        $colors = ['Red', 'Blue', 'Green', 'Yellow'];

        foreach ($colors as $color) {
            AttributeValue::firstOrCreate([
                'attribute_id' => $colorAttribute->id,
                'value' => $color,
            ]);
        }

        // Create Size attribute and values
        $sizeAttribute = Attribute::firstOrCreate(['name' => 'Size']);
        $sizes = ['Small', 'Medium', 'Large', 'X-Large'];

        foreach ($sizes as $size) {
            AttributeValue::firstOrCreate([
                'attribute_id' => $sizeAttribute->id,
                'value' => $size,
            ]);
        }
    }
}

<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;


    protected function setUp(): void
    {
        parent::setUp();

        // Seed the database with all data before each test
        $this->seed(DatabaseSeeder::class);
    }

    public function test_the_user_can_create_a_product()
    {
        // Arrange: Define the data to be used for creating the product
        $data = [
            'name' => 'New Product50',
            'description' => 'Sample product',
            'price' => '99.99',
            'variations' => [
                [
                    'sku' => 'VARIATION-0050',
                    'attributes' => [
                        [
                            'id' => 1,
                            'value_id' => 3,
                        ],
                    ],
                ],
            ],
        ];

        // Act: Make the POST request to store the product
        $response = $this->postJson(route('products.store'), $data);

        // Assert: Check that the response is successful
        $response->assertSuccessful();
        $response->assertJson([
            'custom_code' => 2000,
            'status' => true,
            'message' => 'data_created_successfully',
            'body' => [
                'product' => [
                    'name' => 'New Product50',
                    'description' => 'Sample product',
                    'price' => '99.99',
                ],
            ],
        ]);

        // Assert that the product was created in the database
        $this->assertDatabaseHas('products', [
            'name' => 'New Product50',
            'description' => 'Sample product',
            'price' => '99.99',
        ]);

        // Assert that the product variation was created
        $this->assertDatabaseHas('product_variations', [
            'sku' => 'VARIATION-0050',
        ]);
    }
}

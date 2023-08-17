<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_product_page_contains_empty_table(): void
    {

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/products');

        $response->assertStatus(200);

        $response->assertSee("No Products Found!");
    }

    public function test_product_page_contains_non_empty_table(): void
    {
        Product::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/products');

        $response->assertStatus(200);

        $response->assertDontSee("No Products Found!");
    }

    public function test_paginated_products_table_doesnt_contain_11th_record(): void
    {
        $products = Product::factory(20)->create();

        $firstProduct = $products->first();
        
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/products');

        $response->assertStatus(200);

        $response->assertViewHas("products", function ($collection) use ($firstProduct) {
            return !$collection->contains($firstProduct);
        });

    }
}

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

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser();
    }

    public function test_product_page_contains_empty_table(): void
    {

        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(200);

        $response->assertSee("No Products Found!");
    }

    public function test_product_page_contains_non_empty_table(): void
    {
        Product::factory()->create();

        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(200);

        $response->assertDontSee("No Products Found!");
    }

    public function test_paginated_products_table_doesnt_contain_11th_record(): void
    {
        $products = Product::factory(20)->create();

        $firstProduct = $products->first();

        $response = $this->actingAs($this->user)->get('/products');

        $response->assertStatus(200);

        $response->assertViewHas("products", function ($collection) use ($firstProduct) {
            return !$collection->contains($firstProduct);
        });
    }

    private function createUser(): User
    {
        return User::factory()->create();

    }
}

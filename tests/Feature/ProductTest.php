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
    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createUser();
        $this->admin = $this->createUser(is_admin: true);
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

    public function test_should_admin_can_see_product_create_button()
    {

        $response = $this->actingAs($this->admin)->get('/products');

        $response->assertStatus(200);

        $response->assertSee("Add Product");
    }

    public function test_admin_can_access_product_create_page()
    {

        $response = $this->actingAs($this->admin)->get('/products/create');

        $response->assertStatus(200);

    }

    public function test_non_admin_cannot_access_product_create_page()
    {
        $response = $this->actingAs($this->user)->get('/products/create');

        $response->assertStatus(403);
    }

    public function test_create_product_successful()
    {
        $product = [
            "name" => "Product One",
            "code" => "CODE1",
            "qty" => 223,
            "price" => 1000,
        ];

        $response = $this->actingAs($this->admin)->post("products", $product);

        $response->assertStatus(302);
        $response->assertRedirect("/products");

        $this->assertDatabaseHas("products", $product);

        $lastProduct = Product::latest()->first();

        $this->assertEquals($product['name'], $lastProduct->name);
        $this->assertEquals($product['price'], $lastProduct->price);
    }

    public function test_product_edit_contains_correct_value()
    {
        $product = Product::factory()->create();

        $response = $this->actingAs($this->admin)->get("products/".$product->id."/edit");

        $response->assertStatus(200);
        $response->assertSee('value="'.$product->name.'"', false);
        $response->assertSee('value="'.$product->price.'"', false);
        $response->assertViewHas("product", $product);
    }

    public function test_product_update_redirect_back_to_form_with_validation_error()
    {

        $product = Product::factory()->create();

        $response = $this->actingAs($this->admin)->patch("products/".$product->id, [
            "name" => "",
            "code" => "",
            "qty" => "",
            "price" => "",
        ]);

        $response->assertStatus(302);
        // $response->assertSessionHasErrors(["name","code","qty","price"]);
        $response->assertInvalid(["name","code","qty","price"]);
    }

    public function test_delete_product_successful()
    {
        $product = Product::factory()->create();

        $response = $this->actingAs($this->admin)->delete("products/".$product->id);

        $response->assertStatus(302);
        $response->assertRedirect("/products");
        $this->assertDatabaseMissing("products", $product->toArray());
        $this->assertDatabaseCount("products", 0);
    }

    private function createUser(bool $is_admin = false): User
    {
        return User::factory()->create(["is_admin" => $is_admin]);

    }
}

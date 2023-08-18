<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        return view("products.index", [
            "products" => Product::orderBy("id", "desc")->paginate(10)
        ]);
    }

    public function create()
    {
        return view("products.create");
    }

    public function store(Request $request)
    {
        $product = $request->validate([
            "name" => ["required","string",Rule::unique("products", "name")],
            "code" => ["required","string"],
            "qty" => ["required","numeric"],
            "price" => ["required","numeric"],
        ]);

        Product::create($product);

        return to_route("products.index")->with("success", "Product has been created successfully.");
    }
}

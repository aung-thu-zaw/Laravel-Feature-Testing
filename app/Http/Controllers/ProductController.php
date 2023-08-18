<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
}

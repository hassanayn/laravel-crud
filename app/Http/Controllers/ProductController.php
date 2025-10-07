<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index() {
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }

    public function create() {
        return view('products.create');
    }

    public function store(Request $request) {
        // Validate the request data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'price' => 'required|decimal:0,2',
        ]);

        // Create a new product using the validated data
        $newProduct = Product::create($data);

         return redirect(route('products.index'));

        // Redirect to the products index page with a success message
        // return redirect()->route('products.index')->with('success', 'Product created successfully.');

    }

    public function edit(Product $product) {
        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, Product $product) {
        // Validate the request data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'price' => 'required|decimal:0,2',
        ]);

        // Update the product using the validated data
        $product->update($data);

         return redirect(route('products.index'))->with('success', 'Product updated successfully.');

        
    }
}

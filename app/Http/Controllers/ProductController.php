<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function show_products(Request $request)
    {
        $search = $request->query('search');
        $products = empty($search) ? Product::all() :
            Product::where('title', 'like', '%' . $search . '%')->orWhere('description', 'like', '%' . $search . '%')->get();

        return view('products', ['products' => $products]);
    }

    public function show_product($id)
    {
        $product = Product::findOrFail($id);

        return view('product', ['product' => $product]);
    }

    public function delete_product($id)
    {
        Product::where('id', $id)->delete();

        return to_route('products.show');
    }

    public function show_create_product()
    {
        return view('create_update_product');
    }

    public function show_update_product($id)
    {
        $product = Product::findOrFail($id);

        Log::debug($product);
        return view('create_update_product', ['product' => $product]);
    }

    public function create_product(Request $request)
    {
        $validatedData = $this->validate_product($request);

        $product = new Product;
        $product->title = $validatedData['title'];
        $product->description = $validatedData['description'];
        $product->save();

        return to_route('product.show', $product->id);
    }

    public function update_product(Request $request, $id)
    {
        $validatedData = $this->validate_product($request);

        $product = Product::findOrFail($id);
        $product->title = $validatedData['title'];
        $product->description = $validatedData['description'];
        $product->save();

        return to_route('product.show', $product->id);
    }

    private function validate_product(Request $request)
    {
        return $request->validate([
            'title' => ['required', 'string', 'min:1'],
            'description' => ['required', 'string', 'min:5'],
        ]);
    }
}

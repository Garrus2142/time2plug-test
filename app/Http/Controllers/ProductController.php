<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

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
        $product = Product::findOrFail($id);

        if ($product->photo_filename) {
            Storage::delete('public/products_photos/' . $product->photo_filename);
        }

        $product->delete();

        return to_route('products.show');
    }

    public function show_create_product()
    {
        return view('create_update_product');
    }

    public function show_update_product($id)
    {
        $product = Product::findOrFail($id);

        return view('create_update_product', ['product' => $product]);
    }

    public function create_update_product(Request $request, $id = null)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'min:1'],
            'description' => ['required', 'string', 'min:5'],
        ]);

        $product = $id ? Product::findOrFail($id) : new Product;
        $product->title = $validatedData['title'];
        $product->description = $validatedData['description'];

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $path = $request->file('photo')->store('public/products_photos');
            $product->photo_filename = basename($path);
        }

        $product->save();

        return to_route('product.show', $product->id);
    }
}

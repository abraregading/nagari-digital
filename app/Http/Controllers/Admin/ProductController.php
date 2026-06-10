<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('order')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'icon' => 'required', 'title' => 'required',
            'description' => 'required', 'link' => 'required',
            'color' => 'required', 'order' => 'integer',
            'features' => 'nullable',
        ]);
        $data['features'] = array_filter(explode("\n", $request->features ?? ''));
        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'icon' => 'required', 'title' => 'required',
            'description' => 'required', 'link' => 'required',
            'color' => 'required', 'order' => 'integer',
            'features' => 'nullable',
        ]);
        $data['features'] = array_filter(explode("\n", $request->features ?? ''));
        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}

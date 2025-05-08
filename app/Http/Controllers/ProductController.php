<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('dashboard', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'jumlah' => 'required|integer',
            'harga' => 'required|integer',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'jumlah' => 'required|integer',
            'harga' => 'required|integer',
            'category' => 'required',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($product->photo) {
                Storage::disk('public')->delete($product->photo);
            }
            $validated['photo'] = $request->file('photo')->store('products', 'public');
        }

        $product->update($validated);
        return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->photo) {
            Storage::disk('public')->delete($product->photo);
        }

        $product->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }
}

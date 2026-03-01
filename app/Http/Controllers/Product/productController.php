<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class productController extends Controller
{
    // ─── Buyer ───────────────────────────────────────────────

    public function showBuyerHome()
    {
        $products = Product::query()
            ->where('stock', '>', 0)
            ->with('seller')
            ->latest()
            ->limit(8)
            ->get();

        return view('buyer.home', compact('products'));
    }

    public function showBuyerProduct(Request $request)
    {
        $products = Product::query()
            ->where('stock', '>', 0)
            ->with('seller')
            ->when($request->search, fn($q) => $q->where('name', 'like', '%' . $request->search . '%'))
            ->latest()
            ->paginate(12);

        return view('buyer.products.index', compact('products'));
    }

    public function showBuyerProductDetail(Product $product)
    {
        $product->load('seller');
        return view('buyer.products.show', compact('product'));
    }

    // ─── Seller ──────────────────────────────────────────────

    public function sellerDashboard()
    {
        return view('seller.dashboard');
    }

    public function showSellerProduct()
    {
        $products = auth()
            ->user()
            ->products()
            ->latest()
            ->paginate(10);

        return view('seller.products.index', compact('products'));
    }


    public function create()
    {
        return view('seller.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')
            ? $request->file('image')->store('uploads/products', 'public')
            : null;

        Product::create([
            'seller_id' => auth()->id(),
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
        ]);

        return redirect()->route('seller.products')->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        if ($product->seller_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('seller.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        if ($product->seller_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('uploads/products', 'public');
        }

        $product->update($validated);

        return redirect()->route('seller.products')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        if ($product->seller_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('seller.products')->with('success', 'Product deleted successfully');
    }
}

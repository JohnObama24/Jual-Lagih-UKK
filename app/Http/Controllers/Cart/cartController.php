<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;

class cartController extends Controller
{
    public function addToCart($productId)
    {
        $user = Auth()->user();
        $product = Product::findOrFail($productId);

        DB::beginTransaction();
        try {
            $cart = Cart::firstOrCreate(['user_id' => $user->id]);

            $cartItem = CartItem::where([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
            ])->first();

            if ($cartItem) {
                $cartItem->increment('quantity');
            } else {
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menambahkan ke keranjang');
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function showCart()
    {
        $user = Auth()->user();

        $cart = Cart::where('user_id', $user->id)
            ->with('cartItems.product.seller')
            ->first();

        return view('buyer.cart.index', compact('cart'));
    }

    public function updateQuantity(Request $request, $cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->update(['quantity' => $request->quantity]);

        return back();
    }

    public function remove($cartItemId)
    {
        CartItem::destroy($cartItemId);
        return back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}

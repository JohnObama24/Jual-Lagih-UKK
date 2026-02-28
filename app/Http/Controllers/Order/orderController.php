<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Orders;
use App\Models\OrderItem;
use App\Models\Product;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class orderController extends Controller
{

    public function sellerOrders()
    {
        $sellerId = auth()->id();

        $orders = Orders::whereHas('orderItems.product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })
            ->with([
                'user',
                'orderItems' => function ($query) use ($sellerId) {
                    $query->whereHas('product', function ($q) use ($sellerId) {
                        $q->where('seller_id', $sellerId);
                    })->with('product');
                }
            ])
            ->latest()
            ->paginate(10);

        return view('seller.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Orders $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled'
        ]);

        $sellerId = auth()->id();

        $hasSellerProduct = $order->orderItems()->whereHas('product', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->exists();

        if (!$hasSellerProduct) {
            abort(403, 'bukan punya kmu produyknya');
        }

        DB::beginTransaction();
        try {
            if ($request->status === 'cancelled' && $order->status !== 'cancelled') {
                foreach ($order->orderItems as $item) {
                    $item->product->increment('stock', $item->quantity);
                }
            }
    
            elseif ($order->status === 'cancelled' && $request->status !== 'cancelled') {
                foreach ($order->orderItems as $item) {
                    $item->product->decrement('stock', $item->quantity);
                }
            }

            $order->update([
                'status' => $request->status
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Order status updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }

    public function buyerOrders()
    {
        $buyerId = auth()->id();

        $orders = Orders::where('user_id', $buyerId)
            ->with(['orderItems.product.seller'])
            ->latest()
            ->paginate(10);

        return view('buyer.orders.index', compact('orders'));
    }

    public function checkOut()
    {
        $user = Auth()->user();

        $cart = Cart::where('user_id', $user->id)
            ->with('cartItems.product')
            ->first();

        if (!$cart || $cart->cartItems->isEmpty()) {
            return back()->with('error', 'Cart kosong');
        }

        DB::beginTransaction();

        try {
            $total_price = 0;

            // 1. Cek stok dan hitung total harga
            foreach ($cart->cartItems as $item) {
                if ($item->product->stock < $item->quantity) {
                    return back()->with('error', 'Stok untuk produk ' . $item->product->name . ' tidak mencukupi.');
                }
                $total_price += $item->product->price * $item->quantity;
            }

            $order = Orders::create([
                'user_id' => $user->id,
                'total_price' => $total_price,
                'status' => 'pending'
            ]);

            foreach ($cart->cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price                 ]);

                $item->product->decrement('stock', $item->quantity);
            }

            $cart->cartItems()->delete();

            DB::commit();

            return redirect()->route('buyer.orders')->with('success', 'Checkout berhasil. Pesanan Anda sedang diproses!');

        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Gagal melakukan checkout: ' . $th->getMessage());
        }
    }
}

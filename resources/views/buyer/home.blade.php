@extends('buyer.layouts.app')

@section('title', 'Beranda')
@section('meta_description', 'Temukan produk terbaik di Jual Lagih')

@section('content')

    
    <div
        class="relative bg-linear-to-br from-blue-600 via-blue-700 to-indigo-800 rounded-3xl overflow-hidden mb-10 shadow-xl">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 400 200" fill="none">
                <circle cx="350" cy="-30" r="120" fill="white" />
                <circle cx="30" cy="200" r="80" fill="white" />
            </svg>
        </div>
        <div class="relative px-8 py-12 sm:px-14 sm:py-16 flex flex-col sm:flex-row items-center justify-between gap-8">
            <div class="text-center sm:text-left">
                <h1 class="text-3xl sm:text-4xl font-bold text-white leading-tight mb-3">
                    Selamat datang, <br class="hidden sm:block">
                    <span class="text-blue-200">{{ auth()->user()->name }}!</span>
                </h1>
                <p class="text-blue-100 text-sm sm:text-base mb-6 max-w-md">
                    Temukan ribuan produk berkualitas dengan harga terbaik. Belanja sekarang dan dapatkan penawaran
                    eksklusif!
                </p>
                <a href="{{ route('buyer.products') }}"
                    class="inline-flex items-center gap-2 bg-white text-blue-700 font-semibold px-6 py-3 rounded-xl hover:bg-blue-50 transition shadow-md text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Jelajahi Produk
                </a>
            </div>
            <div
                class="hidden sm:flex w-40 h-40 bg-white/10 backdrop-blur rounded-2xl items-center justify-center shrink-0">
                <svg class="w-20 h-20 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
        </div>
    </div>

    
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-10">
        @php
            $totalProducts = \App\Models\Product::where('stock', '>', 0)->count();
            $totalOrders = \App\Models\Orders::where('user_id', auth()->id())->count();
            $cartCount = \App\Models\Cart::where('user_id', auth()->id())->withCount('cartItems')->first()?->cart_items_count ?? 0;
            $pendingOrders = \App\Models\Orders::where('user_id', auth()->id())->where('status', 'pending')->count();
        @endphp
        <div class="bg-white rounded-2xl border border-blue-100 p-4 flex flex-col gap-1 shadow-sm">
            <span class="text-2xl font-bold text-blue-700">{{ $totalProducts }}</span>
            <span class="text-xs text-gray-500">Produk tersedia</span>
        </div>
        <div class="bg-white rounded-2xl border border-blue-100 p-4 flex flex-col gap-1 shadow-sm">
            <span class="text-2xl font-bold text-blue-700">{{ $totalOrders }}</span>
            <span class="text-xs text-gray-500">Total pesanan</span>
        </div>
        <div class="bg-white rounded-2xl border border-blue-100 p-4 flex flex-col gap-1 shadow-sm">
            <span class="text-2xl font-bold text-blue-700">{{ $cartCount }}</span>
            <span class="text-xs text-gray-500">Item di keranjang</span>
        </div>
        <div class="bg-white rounded-2xl border border-blue-100 p-4 flex flex-col gap-1 shadow-sm">
            <span class="text-2xl font-bold text-orange-500">{{ $pendingOrders }}</span>
            <span class="text-xs text-gray-500">Pesanan pending</span>
        </div>
    </div>

    
    <div class="flex items-center justify-between mb-5">
        <h2 class="text-lg font-bold text-gray-800">Produk Terbaru</h2>
        <a href="{{ route('buyer.products') }}"
            class="text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1">
            Lihat semua
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>

    @if($products->count())
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($products as $product)
                @include('buyer.components.product-card', ['product' => $product])
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-2xl border border-blue-100 p-12 text-center">
            <svg class="w-16 h-16 text-blue-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            <p class="text-gray-500 text-sm">Belum ada produk tersedia.</p>
        </div>
    @endif

@endsection

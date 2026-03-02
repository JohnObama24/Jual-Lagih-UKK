@extends('buyer.layouts.app')

@section('title', 'Beranda')
@section('meta_description', 'Temukan produk terbaik di Jual Lagih')

@section('content')


    <div class="relative bg-blue-600 rounded-2xl overflow-hidden mb-8 shadow-sm group">
        <div class="absolute inset-0 bg-linear-to-r from-blue-700 to-transparent z-10"></div>
        <img src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?q=80&w=2070&auto=format&fit=crop"
             alt="Promo Banner"
             class="absolute inset-0 w-full h-full object-cover object-center group-hover:scale-105 transition duration-700">
        <div class="relative z-20 px-8 py-10 sm:py-16 sm:px-12 flex flex-col justify-center h-full max-w-lg">
            <span class="inline-block px-3 py-1 bg-yellow-400 text-yellow-900 text-xs font-bold rounded-full mb-4 w-max">PROMO SPESIAL</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white leading-tight mb-4">
                Diskon Gede-Gedean<br>Barang Bekas Rasa Baru!
            </h1>
            <p class="text-blue-100 text-sm sm:text-base mb-6 max-w-sm">
                Temukan ribuan produk pilihan dengan kualitas terjamin. Jangan sampai kehabisan!
            </p>
            <a href="{{ route('buyer.products') }}"
                class="inline-flex items-center justify-center gap-2 bg-white text-blue-700 font-bold px-6 py-3 rounded-lg hover:bg-gray-50 transition shadow-sm w-max text-sm">
                Belanja Sekarang
            </a>
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

@extends('buyer.layouts.app')

@section('title', $product->name)

@section('content')

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-xs text-gray-400 mb-6">
        <a href="{{ route('buyer.home') }}" class="hover:text-blue-600 transition">Beranda</a>
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <a href="{{ route('buyer.products') }}" class="hover:text-blue-600 transition">Produk</a>
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-600 truncate max-w-[180px]">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        {{-- Product Image --}}
        <div class="bg-blue-50 rounded-2xl overflow-hidden flex items-center justify-center min-h-72 relative shadow-sm">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                    class="w-full h-full object-cover rounded-2xl max-h-[420px]">
            @else
                <div class="flex flex-col items-center text-blue-200 p-16">
                    <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-sm mt-2">Tidak ada gambar</p>
                </div>
            @endif
            @if($product->stock <= 5 && $product->stock > 0)
                <span class="absolute top-3 left-3 bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                    Sisa {{ $product->stock }} Stok!
                </span>
            @elseif($product->stock == 0)
                <span class="absolute top-3 left-3 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                    Stok Habis
                </span>
            @endif
        </div>

        {{-- Product Info --}}
        <div class="flex flex-col gap-5">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 leading-tight mb-2">{{ $product->name }}</h1>
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Dijual oleh <span class="font-medium text-gray-700">{{ $product->seller->name ?? '-' }}</span>
                </div>
            </div>

            <div class="flex items-baseline gap-3">
                <span class="text-3xl font-bold text-blue-700">
                    Rp{{ number_format($product->price, 0, ',', '.') }}
                </span>
            </div>

            {{-- Stock info --}}
            <div class="flex items-center gap-2 text-sm">
                <svg class="w-4 h-4 {{ $product->stock > 0 ? 'text-green-500' : 'text-red-400' }}" fill="currentColor"
                    viewBox="0 0 20 20">
                    @if($product->stock > 0)
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    @else
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    @endif
                </svg>
                <span class="{{ $product->stock > 0 ? 'text-green-600' : 'text-red-500' }} font-medium">
                    {{ $product->stock > 0 ? 'Stok tersedia (' . $product->stock . ' unit)' : 'Stok habis' }}
                </span>
            </div>

            {{-- Description --}}
            <div class="bg-blue-50 rounded-xl p-4">
                <h3 class="text-sm font-semibold text-gray-700 mb-2">Deskripsi Produk</h3>
                <p class="text-sm text-gray-600 leading-relaxed">{{ $product->description }}</p>
            </div>

            {{-- Add to Cart --}}
            @if($product->stock > 0)
                <form method="POST" action="{{ route('cart.add', $product->id) }}" class="flex flex-col gap-3">
                    @csrf
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Tambah ke Keranjang
                    </button>
                </form>
            @else
                <button disabled class="w-full bg-gray-100 text-gray-400 font-semibold py-3 rounded-xl cursor-not-allowed">
                    Stok Habis
                </button>
            @endif

            <a href="{{ route('buyer.products') }}"
                class="text-sm text-blue-600 hover:text-blue-700 text-center flex items-center justify-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke daftar produk
            </a>
        </div>
    </div>

@endsection
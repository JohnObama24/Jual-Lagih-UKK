@extends('buyer.layouts.app')

@section('title', 'Semua Produk')

@section('content')

    {{-- Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Semua Produk</h1>
        <p class="text-sm text-gray-500 mt-1">Temukan produk yang kamu butuhkan</p>
    </div>

    {{-- Search & Filter --}}
    <div class="bg-white rounded-2xl border border-blue-100 p-4 mb-6 shadow-sm">
        <form method="GET" action="{{ route('buyer.products') }}" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1 relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                    class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm">
            </div>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2.5 rounded-xl transition text-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('buyer.products') }}"
                    class="border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium px-5 py-2.5 rounded-xl transition text-sm flex items-center justify-center">
                    Reset
                </a>
            @endif
        </form>
    </div>

    {{-- Result info --}}
    <div class="flex items-center justify-between mb-4">
        <p class="text-sm text-gray-500">
            {{ $products->total() }} produk ditemukan
            @if(request('search'))
                untuk "<span class="font-medium text-gray-700">{{ request('search') }}</span>"
            @endif
        </p>
    </div>

    {{-- Product Grid --}}
    @if($products->count())
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($products as $product)
                @include('buyer.components.product-card', ['product' => $product])
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8 flex justify-center">
            {{ $products->appends(request()->query())->links() }}
        </div>
    @else
        <div class="bg-white rounded-2xl border border-blue-100 p-12 text-center">
            <svg class="w-16 h-16 text-blue-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
            <p class="text-gray-500 text-sm font-medium">Produk tidak ditemukan.</p>
            <a href="{{ route('buyer.products') }}" class="mt-3 inline-block text-blue-600 text-sm hover:underline">
                Lihat semua produk
            </a>
        </div>
    @endif

@endsection
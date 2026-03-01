@extends('buyer.layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Keranjang Belanja</h1>
        <p class="text-sm text-gray-500 mt-1">Review pesananmu sebelum checkout</p>
    </div>

    @if($cart && $cart->cartItems->count())
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Cart Items --}}
            <div class="lg:col-span-2 flex flex-col gap-3">
                @foreach($cart->cartItems as $item)
                    <div class="bg-white rounded-2xl border border-blue-100 p-4 shadow-sm flex gap-4 items-start">
                        {{-- Product Image --}}
                        <div class="w-20 h-20 bg-blue-50 rounded-xl overflow-hidden shrink-0">
                            @if($item->product->image)
                                <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-blue-200">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <a href="{{ route('buyer.product.show', $item->product->id) }}"
                                class="text-sm font-semibold text-gray-800 hover:text-blue-600 transition truncate block">
                                {{ $item->product->name }}
                            </a>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $item->product->seller->name ?? '-' }}</p>
                            <p class="text-blue-700 font-bold text-sm mt-1">
                                Rp{{ number_format($item->product->price, 0, ',', '.') }}
                            </p>

                            {{-- Quantity & Remove --}}
                            <div class="flex items-center gap-3 mt-3">
                                {{-- Decrease --}}
                                <form method="POST" action="{{ route('cart.update', $item->id) }}">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">
                                    <button type="submit"
                                        class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-blue-50 hover:border-blue-300 transition"
                                        {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                        </svg>
                                    </button>
                                </form>

                                <span class="w-8 text-center text-sm font-semibold text-gray-700">{{ $item->quantity }}</span>

                                {{-- Increase --}}
                                <form method="POST" action="{{ route('cart.update', $item->id) }}">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                    <button type="submit"
                                        class="w-7 h-7 rounded-lg border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-blue-50 hover:border-blue-300 transition"
                                        {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                </form>

                                <span class="text-sm font-semibold text-gray-700 ml-2">
                                    = Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                </span>

                                {{-- Remove --}}
                                <form method="POST" action="{{ route('cart.remove', $item->id) }}" class="ml-auto">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 transition p-1"
                                        onclick="return confirm('Hapus item ini?')">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Order Summary --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl border border-blue-100 p-5 shadow-sm sticky top-24">
                    <h2 class="text-base font-bold text-gray-800 mb-4">Ringkasan Pesanan</h2>

                    <div class="space-y-2 mb-4">
                        @php $total = 0 @endphp
                        @foreach($cart->cartItems as $item)
                            @php $total += $item->product->price * $item->quantity @endphp
                            <div class="flex justify-between text-sm text-gray-600">
                                <span class="truncate max-w-[160px]">{{ $item->product->name }} ×{{ $item->quantity }}</span>
                                <span>Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-blue-100 pt-3 mb-5">
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-gray-800">Total</span>
                            <span class="font-bold text-blue-700 text-lg">Rp{{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('order.checkout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition shadow-md hover:shadow-lg flex items-center justify-center gap-2"
                            onclick="return confirm('Lanjutkan checkout?')">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Checkout Sekarang
                        </button>
                    </form>

                    <a href="{{ route('buyer.products') }}"
                        class="block text-center text-sm text-blue-600 hover:text-blue-700 mt-3">
                        Lanjut belanja
                    </a>
                </div>
            </div>
        </div>

    @else
        {{-- Empty Cart --}}
        <div class="bg-white rounded-2xl border border-blue-100 p-16 text-center shadow-sm">
            <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <h2 class="text-lg font-bold text-gray-700 mb-2">Keranjang Kosong</h2>
            <p class="text-sm text-gray-500 mb-6">Belum ada produk di keranjangmu. Mulai belanja sekarang!</p>
            <a href="{{ route('buyer.products') }}"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-xl transition shadow-md text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Mulai Belanja
            </a>
        </div>
    @endif

@endsection
@extends('buyer.layouts.app')

@section('title', 'Pesanan Saya')

@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Pesanan Saya</h1>
        <p class="text-sm text-gray-500 mt-1">Riwayat dan status semua pesananmu</p>
    </div>

    @if($orders->count())
        <div class="flex flex-col gap-4">
            @foreach($orders as $order)
                @php
                    $statusConfig = [
                        'pending' => ['label' => 'Menunggu', 'bg' => 'bg-yellow-100', 'text' => 'text-yellow-700', 'dot' => 'bg-yellow-500'],
                        'processing' => ['label' => 'Diproses', 'bg' => 'bg-blue-100', 'text' => 'text-blue-700', 'dot' => 'bg-blue-500'],
                        'shipped' => ['label' => 'Dikirim', 'bg' => 'bg-indigo-100', 'text' => 'text-indigo-700', 'dot' => 'bg-indigo-500'],
                        'completed' => ['label' => 'Selesai', 'bg' => 'bg-green-100', 'text' => 'text-green-700', 'dot' => 'bg-green-500'],
                        'cancelled' => ['label' => 'Dibatalkan', 'bg' => 'bg-red-100', 'text' => 'text-red-700', 'dot' => 'bg-red-500'],
                    ];
                    $sc = $statusConfig[$order->status] ?? ['label' => $order->status, 'bg' => 'bg-gray-100', 'text' => 'text-gray-600', 'dot' => 'bg-gray-400'];
                @endphp
                <div class="bg-white rounded-2xl border border-blue-100 shadow-sm overflow-hidden">
                    {{-- Order Header --}}
                    <div class="flex items-center justify-between px-5 py-3 border-b border-blue-50 bg-blue-50/50">
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-semibold text-gray-500">Order #{{ $order->id }}</span>
                            <span class="text-xs text-gray-400">•</span>
                            <span class="text-xs text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <span
                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold {{ $sc['bg'] }} {{ $sc['text'] }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $sc['dot'] }}"></span>
                            {{ $sc['label'] }}
                        </span>
                    </div>

                    {{-- Order Items --}}
                    <div class="px-5 py-4 divide-y divide-gray-50">
                        @foreach($order->orderItems as $item)
                            <div class="flex items-center gap-3 py-3 first:pt-0 last:pb-0">
                                <div class="w-12 h-12 bg-blue-50 rounded-xl overflow-hidden shrink-0">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-blue-200">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-800 truncate">
                                        {{ $item->product->name ?? 'Produk telah dihapus' }}
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        {{ $item->quantity }} × Rp{{ number_format($item->price, 0, ',', '.') }}
                                    </p>
                                </div>
                                <p class="text-sm font-semibold text-gray-700">
                                    Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    {{-- Order Footer --}}
                    <div class="px-5 py-3 border-t border-blue-50 bg-blue-50/30 flex items-center justify-between">
                        <span class="text-xs text-gray-500">
                            {{ $order->orderItems->count() }} produk
                        </span>
                        <div class="text-right">
                            <span class="text-xs text-gray-500">Total</span>
                            <p class="text-base font-bold text-blue-700">
                                Rp{{ number_format($order->total_price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8 flex justify-center">
            {{ $orders->links() }}
        </div>

    @else
        <div class="bg-white rounded-2xl border border-blue-100 p-16 text-center shadow-sm">
            <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <h2 class="text-lg font-bold text-gray-700 mb-2">Belum Ada Pesanan</h2>
            <p class="text-sm text-gray-500 mb-6">Kamu belum pernah melakukan pesanan. Yuk mulai belanja!</p>
            <a href="{{ route('buyer.products') }}"
                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-xl transition shadow-md text-sm">
                Mulai Belanja
            </a>
        </div>
    @endif

@endsection
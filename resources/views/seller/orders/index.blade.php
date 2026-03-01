@extends('seller.layouts.app')

@section('title', 'Pesanan Masuk')

@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Pesanan Masuk</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola dan update status pesanan dari pembeli</p>
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
                    
                    <div class="flex flex-wrap items-center justify-between gap-3 px-5 py-3 border-b border-blue-50 bg-blue-50/40">
                        <div class="flex items-center flex-wrap gap-3">
                            <span class="text-xs font-semibold text-gray-600">Order #{{ $order->id }}</span>
                            <span class="text-xs text-gray-400">•</span>
                            <div class="flex items-center gap-1.5 text-xs text-gray-500">
                                <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                {{ $order->user->name }}
                            </div>
                            <span class="text-xs text-gray-400">•</span>
                            <span class="text-xs text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <span
                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold {{ $sc['bg'] }} {{ $sc['text'] }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $sc['dot'] }}"></span>
                            {{ $sc['label'] }}
                        </span>
                    </div>

                    
                    <div class="px-5 py-3 divide-y divide-gray-50">
                        @foreach($order->orderItems as $item)
                            <div class="flex items-center gap-3 py-2.5 first:pt-0 last:pb-0">
                                <div class="w-10 h-10 bg-blue-50 rounded-xl overflow-hidden shrink-0">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-blue-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16" />
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-800 truncate">{{ $item->product->name ?? 'Produk dihapus' }}
                                    </p>
                                    <p class="text-xs text-gray-400">{{ $item->quantity }} ×
                                        Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                                <p class="text-sm font-semibold text-gray-700 shrink-0">
                                    Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    
                    <div class="px-5 py-3 border-t border-blue-50 bg-blue-50/20 flex flex-wrap items-center justify-between gap-3">
                        <div>
                            <span class="text-xs text-gray-500">Total Pesanan</span>
                            <p class="text-base font-bold text-blue-700">Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>

                        
                        @if($order->status !== 'completed' && $order->status !== 'cancelled')
                            <form method="POST" action="{{ route('seller.orders.updateStatus', $order->id) }}"
                                class="flex items-center gap-2">
                                @csrf @method('PATCH')
                                <select name="status"
                                    class="text-sm border border-gray-200 rounded-xl px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Proses</option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Kirim</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Batalkan</option>
                                </select>
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded-xl transition">
                                    Update
                                </button>
                            </form>
                        @else
                            <span class="text-xs text-gray-400 italic">Status final – tidak bisa diubah</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8 flex justify-center">
            {{ $orders->links() }}
        </div>

    @else
        <div class="bg-white rounded-2xl border border-blue-100 p-16 text-center shadow-sm">
            <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" />
                </svg>
            </div>
            <h2 class="text-lg font-bold text-gray-700 mb-2">Belum Ada Pesanan</h2>
            <p class="text-sm text-gray-500">Pesanan dari pembeli akan muncul di sini.</p>
        </div>
    @endif

@endsection

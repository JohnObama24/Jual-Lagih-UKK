@extends('seller.layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-sm text-gray-500 mt-1">Halo, <span
                class="font-medium text-blue-600">{{ auth()->user()->name }}</span>! Ini ringkasan toko kamu hari ini.</p>
    </div>

    
    @php
        $sellerId = auth()->id();
        $totalProducts = auth()->user()->products()->count();
        $totalStock = auth()->user()->products()->sum('stock');
        $totalOrders = \App\Models\Orders::whereHas('orderItems.product', fn($q) => $q->where('seller_id', $sellerId))->count();
        $pendingOrders = \App\Models\Orders::whereHas('orderItems.product', fn($q) => $q->where('seller_id', $sellerId))->where('status', 'pending')->count();
        $completedOrders = \App\Models\Orders::whereHas('orderItems.product', fn($q) => $q->where('seller_id', $sellerId))->where('status', 'completed')->count();
        $totalRevenue = \App\Models\OrderItem::whereHas('product', fn($q) => $q->where('seller_id', $sellerId))
            ->whereHas('order', fn($q) => $q->where('status', 'completed'))
            ->selectRaw('SUM(price * quantity) as total')->value('total') ?? 0;
    @endphp

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-2xl border border-blue-100 p-5 shadow-sm">
            <div class="flex items-start justify-between mb-3">
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-800">{{ $totalProducts }}</p>
            <p class="text-xs text-gray-500 mt-0.5">Total Produk</p>
        </div>

        <div class="bg-white rounded-2xl border border-blue-100 p-5 shadow-sm">
            <div class="flex items-start justify-between mb-3">
                <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-800">{{ $totalOrders }}</p>
            <p class="text-xs text-gray-500 mt-0.5">Total Pesanan</p>
        </div>

        <div class="bg-white rounded-2xl border border-blue-100 p-5 shadow-sm">
            <div class="flex items-start justify-between mb-3">
                <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-orange-500">{{ $pendingOrders }}</p>
            <p class="text-xs text-gray-500 mt-0.5">Pesanan Pending</p>
        </div>

        <div class="bg-white rounded-2xl border border-blue-100 p-5 shadow-sm">
            <div class="flex items-start justify-between mb-3">
                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-green-600">Rp{{ number_format($totalRevenue / 1000, 0, ',', '.') }}k</p>
            <p class="text-xs text-gray-500 mt-0.5">Pendapatan (selesai)</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        
        <div class="bg-white rounded-2xl border border-blue-100 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-blue-50 flex items-center justify-between">
                <h2 class="text-sm font-bold text-gray-800">Produk Terbaru</h2>
                <a href="{{ route('seller.products') }}" class="text-xs text-blue-600 hover:text-blue-700 font-medium">Lihat
                    semua →</a>
            </div>
            @php $recentProducts = auth()->user()->products()->latest()->limit(5)->get(); @endphp
            @if($recentProducts->count())
                <div class="divide-y divide-gray-50">
                    @foreach($recentProducts as $product)
                        <div class="flex items-center gap-3 px-5 py-3">
                            <div class="w-10 h-10 bg-blue-50 rounded-xl overflow-hidden shrink-0">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
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
                                <p class="text-sm font-medium text-gray-800 truncate">{{ $product->name }}</p>
                                <p class="text-xs text-gray-400">Stok: {{ $product->stock }}</p>
                            </div>
                            <span
                                class="text-sm font-semibold text-blue-700 shrink-0">Rp{{ number_format($product->price / 1000, 0, ',', '.') }}k</span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="px-5 py-8 text-center text-sm text-gray-400">Belum ada produk.</div>
            @endif
        </div>

        
        <div class="bg-white rounded-2xl border border-blue-100 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-blue-50 flex items-center justify-between">
                <h2 class="text-sm font-bold text-gray-800">Pesanan Terbaru</h2>
                <a href="{{ route('seller.orders') }}" class="text-xs text-blue-600 hover:text-blue-700 font-medium">Lihat
                    semua →</a>
            </div>
            @php
                $recentOrders = \App\Models\Orders::whereHas('orderItems.product', fn($q) => $q->where('seller_id', $sellerId))
                    ->with('user')->latest()->limit(5)->get();
                $statusConfig = [
                    'pending' => ['label' => 'Pending', 'bg' => 'bg-yellow-100', 'text' => 'text-yellow-700'],
                    'processing' => ['label' => 'Diproses', 'bg' => 'bg-blue-100', 'text' => 'text-blue-700'],
                    'shipped' => ['label' => 'Dikirim', 'bg' => 'bg-indigo-100', 'text' => 'text-indigo-700'],
                    'completed' => ['label' => 'Selesai', 'bg' => 'bg-green-100', 'text' => 'text-green-700'],
                    'cancelled' => ['label' => 'Batal', 'bg' => 'bg-red-100', 'text' => 'text-red-700'],
                ];
            @endphp
            @if($recentOrders->count())
                <div class="divide-y divide-gray-50">
                    @foreach($recentOrders as $order)
                        @php $sc = $statusConfig[$order->status] ?? ['label' => $order->status, 'bg' => 'bg-gray-100', 'text' => 'text-gray-600']; @endphp
                        <div class="flex items-center gap-3 px-5 py-3">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-800">#{{ $order->id }} — {{ $order->user->name }}</p>
                                <p class="text-xs text-gray-400">{{ $order->created_at->diffForHumans() }}</p>
                            </div>
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $sc['bg'] }} {{ $sc['text'] }} shrink-0">
                                {{ $sc['label'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="px-5 py-8 text-center text-sm text-gray-400">Belum ada pesanan.</div>
            @endif
        </div>
    </div>

@endsection

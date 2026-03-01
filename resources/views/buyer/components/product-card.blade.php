
<div
    class="bg-white rounded-2xl shadow-sm border border-blue-50 overflow-hidden hover:shadow-md hover:-translate-y-0.5 transition duration-200 flex flex-col">
    
    <a href="{{ route('buyer.product.show', $product->id) }}" class="block relative overflow-hidden bg-blue-50"
        style="padding-top: 75%;">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                class="absolute inset-0 w-full h-full object-cover hover:scale-105 transition duration-300">
        @else
            <div class="absolute inset-0 flex items-center justify-center text-blue-200">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        @endif
        
        @if($product->stock <= 5 && $product->stock > 0)
            <span class="absolute top-2 left-2 bg-orange-500 text-white text-xs font-semibold px-2 py-0.5 rounded-full">
                Sisa {{ $product->stock }}
            </span>
        @elseif($product->stock == 0)
            <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-semibold px-2 py-0.5 rounded-full">
                Habis
            </span>
        @endif
    </a>

    
    <div class="p-4 flex flex-col gap-2 flex-1">
        <a href="{{ route('buyer.product.show', $product->id) }}"
            class="text-sm font-semibold text-gray-800 hover:text-blue-600 transition line-clamp-2 leading-snug">
            {{ $product->name }}
        </a>

        <p class="text-xs text-gray-400 flex items-center gap-1">
            <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            {{ $product->seller->name ?? 'Penjual' }}
        </p>

        <div class="mt-auto pt-2 flex items-center justify-between gap-2">
            <span class="text-blue-700 font-bold text-base">
                Rp{{ number_format($product->price, 0, ',', '.') }}
            </span>

            @if($product->stock > 0)
                <form method="POST" action="{{ route('cart.add', $product->id) }}">
                    @csrf
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium px-3 py-1.5 rounded-lg transition flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Keranjang
                    </button>
                </form>
            @else
                <span class="text-xs text-gray-400 font-medium">Stok habis</span>
            @endif
        </div>
    </div>
</div>

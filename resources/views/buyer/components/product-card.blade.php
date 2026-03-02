<div
    class="bg-white rounded-xl shadow-xs border border-gray-200 overflow-hidden hover:shadow-md hover:border-blue-400 transition duration-200 flex flex-col group h-full">

    <a href="{{ route('buyer.product.show', $product->id) }}"
        class="block relative w-full pt-[100%] bg-gray-50 overflow-hidden">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500">
        @else
            <div class="absolute inset-0 flex items-center justify-center text-gray-300">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        @endif

        @if($product->stock <= 5 && $product->stock > 0)
            <div
                class="absolute bottom-0 left-0 right-0 bg-red-500/80 backdrop-blur-sm text-white text-[10px] font-bold px-2 py-1 text-center">
                Segera Habis! Sisa {{ $product->stock }}
            </div>
        @elseif($product->stock == 0)
            <div class="absolute inset-0 bg-black/40 flex items-center justify-center backdrop-blur-xs">
                <span class="bg-gray-800 text-white text-xs font-bold px-3 py-1 rounded-full">Habis Terjual</span>
            </div>
        @endif
    </a>


    <div class="p-3 flex flex-col flex-1">

        <a href="{{ route('buyer.product.show', $product->id) }}"
            class="text-[13px] text-gray-800 hover:text-blue-600 transition line-clamp-2 leading-tight mb-2 min-h-[36px]">
            {{ $product->name }}
        </a>


        <div class="text-base font-extrabold text-gray-900 mb-1">
            Rp{{ number_format($product->price, 0, ',', '.') }}
        </div>


        <div class="flex items-center gap-1 mb-2 mt-auto">
            <svg class="w-3.5 h-3.5 text-blue-600 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
            </svg>
            <span class="text-[11px] text-gray-500 truncate">{{ $product->seller->name ?? 'Toko Terpercaya' }}</span>
        </div>


        <div class="flex items-center text-[11px] text-gray-500 mb-2">
            <svg class="w-3.5 h-3.5 text-yellow-400 mr-1 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            <span class="mr-1">4.9</span>
            <span class="mx-1 text-gray-300">|</span>
            <span>Terjual {{ rand(10, 500) }}+</span>
        </div>


        @if($product->stock > 0)
            <form method="POST" action="{{ route('cart.add', $product->id) }}" class="mt-2 relative z-10 w-full">
                @csrf
                <button type="submit"
                    class="w-full bg-white border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white text-xs font-bold py-1.5 rounded-lg transition-colors duration-200">
                    + Keranjang
                </button>
            </form>
        @else
            <button disabled
                class="mt-2 w-full bg-gray-100 text-gray-400 text-xs font-bold py-1.5 rounded-lg cursor-not-allowed">
                Stok Habis
            </button>
        @endif
    </div>
</div>

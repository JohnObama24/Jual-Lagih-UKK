<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Jual Lagih') – Jual Lagih</title>
    <meta name="description" content="@yield('meta_description', 'Belanja produk terbaik di Jual Lagih')">

    @vite('resources/css/app.css')

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
            z-index: 9999;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

    
    <nav class="bg-white border-b border-blue-100 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                
                <a href="{{ route('buyer.home') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-blue-700 tracking-tight">Jual Lagih</span>
                </a>

                
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('buyer.home') }}"
                        class="text-sm font-medium {{ request()->routeIs('buyer.home') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} transition">
                        Beranda
                    </a>
                    <a href="{{ route('buyer.products') }}"
                        class="text-sm font-medium {{ request()->routeIs('buyer.products') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} transition">
                        Produk
                    </a>
                    <a href="{{ route('buyer.orders') }}"
                        class="text-sm font-medium {{ request()->routeIs('buyer.orders') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} transition">
                        Pesanan
                    </a>
                </div>

                
                <div class="flex items-center gap-3">
                    
                    <a href="{{ route('cart.index') }}"
                        class="relative p-2 text-gray-600 hover:text-blue-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        @php
                            $cartCount = 0;
                            if (auth()->check()) {
                                $cartModel = \App\Models\Cart::where('user_id', auth()->id())->withCount('cartItems')->first();
                                $cartCount = $cartModel ? $cartModel->cart_items_count : 0;
                            }
                        @endphp
                        @if($cartCount > 0)
                            <span
                                class="absolute -top-0.5 -right-0.5 bg-blue-600 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center font-bold">
                                {{ $cartCount > 9 ? '9+' : $cartCount }}
                            </span>
                        @endif
                    </a>

                    
                    <div class="relative dropdown">
                        <button
                            class="flex items-center gap-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition focus:outline-none">
                            <div
                                class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-700 font-semibold text-xs uppercase">
                                {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                            </div>
                            <span
                                class="hidden sm:block max-w-[100px] truncate">{{ auth()->user()->name ?? 'User' }}</span>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        
                        <div class="dropdown-menu hidden absolute right-0 w-48 pt-2 z-50">
                            <div class="bg-white rounded-xl shadow-lg border border-gray-100 py-1">
                                <a href="{{ route('buyer.profile.edit') }}"
                                    class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profil Saya
                                </a>
                                <a href="{{ route('buyer.orders') }}"
                                    class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    Pesanan Saya
                                </a>
                                <hr class="my-1 border-gray-100">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center gap-2 w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    
                    <button id="mobile-menu-btn" class="md:hidden p-2 text-gray-600 hover:text-blue-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        
        <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-blue-50 px-4 py-3 space-y-2">
            <a href="{{ route('buyer.home') }}"
                class="block py-2 text-sm font-medium text-gray-600 hover:text-blue-600">Beranda</a>
            <a href="{{ route('buyer.products') }}"
                class="block py-2 text-sm font-medium text-gray-600 hover:text-blue-600">Produk</a>
            <a href="{{ route('buyer.orders') }}"
                class="block py-2 text-sm font-medium text-gray-600 hover:text-blue-600">Pesanan</a>
        </div>
    </nav>

    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        @if(session('success'))
            <div class="mt-4 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl flex items-center gap-2"
                role="alert">
                <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mt-4 bg-red-50 border border-red-200 text-red-600 text-sm px-4 py-3 rounded-xl flex items-center gap-2"
                role="alert">
                <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                {{ session('error') }}
            </div>
        @endif
    </div>

    
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    
    <footer class="bg-white border-t border-blue-100 mt-12">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 bg-blue-600 rounded-md flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <span class="text-sm font-semibold text-blue-700">Jual Lagih</span>
            </div>
            <p class="text-xs text-gray-400">© {{ date('Y') }} Jual Lagih. Semua hak dilindungi.</p>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn')?.addEventListener('click', () => {
            document.getElementById('mobile-menu')?.classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>

</html>

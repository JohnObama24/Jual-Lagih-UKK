<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') – Jual Lagih Seller</title>
    <meta name="description" content="@yield('meta_description', 'Kelola toko Anda di Jual Lagih')">

    @vite('resources/css/app.css')

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .sidebar-link.active {
            background: rgb(37 99 235 / 0.1);
            color: #1d4ed8;
            font-weight: 600;
        }

        .sidebar-link.active svg {
            color: #2563eb;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

    {{-- ===== TOP NAVBAR ===== --}}
    <nav class="bg-white border-b border-blue-100 shadow-sm sticky top-0 z-50 h-16 flex items-center">
        <div class="w-full px-4 sm:px-6 flex items-center justify-between">

            {{-- Left: Hamburger + Logo --}}
            <div class="flex items-center gap-3">
                <button id="sidebar-toggle"
                    class="p-1.5 rounded-lg text-gray-500 hover:bg-blue-50 hover:text-blue-600 transition lg:hidden">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <a href="{{ route('seller.dashboard') }}" class="flex items-center gap-2">
                    <div class="w-7 h-7 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-blue-700 tracking-tight hidden sm:block">Jual Lagih</span>
                    <span
                        class="text-xs bg-blue-100 text-blue-600 font-semibold px-2 py-0.5 rounded-full hidden sm:block">Seller</span>
                </a>
            </div>

            {{-- Right: User --}}
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-semibold text-gray-800 leading-none">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">Penjual</p>
                </div>
                <div
                    class="w-9 h-9 bg-linear-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-sm uppercase">
                    {{ substr(auth()->user()->name ?? 'S', 0, 1) }}
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="p-2 rounded-lg text-gray-500 hover:bg-red-50 hover:text-red-500 transition"
                        title="Keluar">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="flex flex-1 min-h-0">

        {{-- ===== SIDEBAR ===== --}}
        <aside id="sidebar"
            class="fixed lg:sticky top-16 left-0 h-[calc(100vh-4rem)] w-60 bg-white border-r border-blue-100 shadow-sm z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-200 flex flex-col shrink-0 overflow-y-auto">
            <nav class="flex-1 px-3 py-5 space-y-1">

                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-3">Menu Utama</p>

                <a href="{{ route('seller.dashboard') }}"
                    class="sidebar-link {{ request()->routeIs('seller.dashboard') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('seller.products') }}"
                    class="sidebar-link {{ request()->routeIs('seller.products') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    Produk Saya
                    @php $pCount = auth()->user()->products()->count(); @endphp
                    @if($pCount)
                        <span
                            class="ml-auto text-xs bg-blue-100 text-blue-600 font-semibold px-2 py-0.5 rounded-full">{{ $pCount }}</span>
                    @endif
                </a>

                <a href="{{ route('seller.orders') }}"
                    class="sidebar-link {{ request()->routeIs('seller.orders') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Pesanan Masuk
                    @php
                        $pendingCount = \App\Models\Orders::whereHas('orderItems.product', fn($q) => $q->where('seller_id', auth()->id()))
                            ->where('status', 'pending')->count();
                    @endphp
                    @if($pendingCount)
                        <span
                            class="ml-auto text-xs bg-orange-100 text-orange-600 font-semibold px-2 py-0.5 rounded-full">{{ $pendingCount }}</span>
                    @endif
                </a>

                <hr class="my-3 border-blue-50">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-3">Akun</p>

                <a href="{{ route('seller.profile.edit') }}"
                    class="sidebar-link {{ request()->routeIs('seller.profile.edit') ? 'active' : '' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition group">
                    <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Profil Saya
                </a>
            </nav>
        </aside>

        {{-- ===== MAIN ===== --}}
        <div class="flex-1 min-w-0 flex flex-col">

            {{-- Flash Messages --}}
            <div class="px-4 sm:px-6 lg:px-8">
                @if(session('success'))
                    <div
                        class="mt-4 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl flex items-center gap-2">
                        <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div
                        class="mt-4 bg-red-50 border border-red-200 text-red-600 text-sm px-4 py-3 rounded-xl flex items-center gap-2">
                        <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6">
                @yield('content')
            </main>

            <footer class="px-4 sm:px-6 lg:px-8 py-4 border-t border-blue-50">
                <p class="text-xs text-gray-400">© {{ date('Y') }} Jual Lagih. Semua hak dilindungi.</p>
            </footer>
        </div>
    </div>

    {{-- Sidebar overlay for mobile --}}
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/30 z-30 hidden lg:hidden"></div>

    <script>
        const btn = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        btn?.addEventListener('click', toggleSidebar);
        overlay?.addEventListener('click', toggleSidebar);
    </script>

    @stack('scripts')
</body>

</html>
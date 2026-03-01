<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jual Lagih – Marketplace Barang Bekas</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white text-slate-800">

    
    <nav class="border-b border-slate-100 px-6 py-4">
        <div class="max-w-5xl mx-auto flex items-center justify-between">
            <a href="/" class="flex items-center gap-2">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <span class="font-bold text-lg text-blue-600">Jual Lagih</span>
            </a>
            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-blue-600 px-3 py-2 transition-colors">Masuk</a>
                <a href="{{ route('register') }}" class="text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition-colors">
                    Daftar
                </a>
            </div>
        </div>
    </nav>

    
    <section class="max-w-5xl mx-auto px-6 py-20 text-center">
        <span class="inline-block text-xs font-semibold text-blue-600 bg-blue-50 border border-blue-100 px-3 py-1 rounded-full mb-5">
            🎉 Marketplace Barang Bekas Terpercaya
        </span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 leading-tight mb-5">
            Jual & Beli Barang Bekas<br class="hidden sm:block">
            <span class="text-blue-600">Mudah dan Aman</span>
        </h1>
        <p class="text-slate-500 text-base sm:text-lg max-w-xl mx-auto mb-8">
            Temukan ribuan produk bekas berkualitas dengan harga terjangkau. Dari elektronik, fashion, hingga furnitur.
        </p>

        
        <div class="flex flex-col sm:flex-row gap-2 max-w-lg mx-auto mb-10">
            <input type="text"
                   placeholder="Cari barang bekas..."
                   class="flex-1 border border-slate-200 rounded-lg px-4 py-3 text-sm text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <button class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-6 py-3 rounded-lg transition-colors whitespace-nowrap">
                Cari
            </button>
        </div>

        
        <div class="flex justify-center gap-8 sm:gap-12">
            <div>
                <p class="text-2xl font-bold text-slate-900">50K+</p>
                <p class="text-sm text-slate-400">Produk Aktif</p>
            </div>
            <div class="w-px bg-slate-200"></div>
            <div>
                <p class="text-2xl font-bold text-slate-900">20K+</p>
                <p class="text-sm text-slate-400">Penjual</p>
            </div>
            <div class="w-px bg-slate-200"></div>
            <div>
                <p class="text-2xl font-bold text-slate-900">4.9⭐</p>
                <p class="text-sm text-slate-400">Rating</p>
            </div>
        </div>
    </section>

    
    <section class="bg-slate-50 py-16">
        <div class="max-w-5xl mx-auto px-6">
            <h2 class="text-2xl font-bold text-slate-900 mb-8">Kategori</h2>
            <div class="grid grid-cols-3 sm:grid-cols-6 gap-3">
                @foreach([
                        ['📱', 'Elektronik'],
                        ['👗', 'Fashion'],
                        ['🛋️', 'Furnitur'],
                        ['🚗', 'Otomotif'],
                        ['📚', 'Buku'],
                        ['🏠', 'Rumah'],
                    ] as [$icon, $name])
                    <a href="#" class="bg-white border border-slate-200 hover:border-blue-300 hover:bg-blue-50 rounded-xl p-4 flex flex-col items-center gap-2 transition-colors group">
                        <span class="text-2xl">{{ $icon }}</span>
                        <span class="text-xs font-medium text-slate-600 group-hover:text-blue-600">{{ $name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    
    <section class="py-16">
        <div class="max-w-5xl mx-auto px-6">
            <h2 class="text-2xl font-bold text-slate-900 mb-10 text-center">Cara Kerja</h2>
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6 text-center">
                @foreach([
                        ['📝', '1. Daftar', 'Buat akun gratis dalam 2 menit'],
                        ['📸', '2. Upload', 'Foto produk & tentukan harga'],
                        ['🤝', '3. Terima Pesanan', 'Konfirmasi & siapkan barang'],
                        ['💰', '4. Dapat Uang', 'Kirim barang, uang masuk'],
                    ] as [$icon, $title, $desc])
                    <div class="flex flex-col items-center gap-3">
                        <div class="w-14 h-14 bg-blue-50 border border-blue-100 rounded-2xl flex items-center justify-center text-2xl">
                            {{ $icon }}
                        </div>
                        <p class="font-semibold text-slate-800 text-sm">{{ $title }}</p>
                        <p class="text-slate-400 text-xs">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    
    <section class="bg-blue-600 py-14">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-white mb-3">Siap Mulai Jual atau Beli?</h2>
            <p class="text-blue-200 text-sm mb-7">Gratis daftar. Ribuan produk menunggumu.</p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('register') }}" class="bg-white text-blue-600 font-bold px-7 py-3 rounded-lg hover:bg-blue-50 transition-colors text-sm">
                    Daftar Gratis
                </a>
                <a href="#" class="border border-white/40 text-white font-medium px-7 py-3 rounded-lg hover:bg-blue-500 transition-colors text-sm">
                    Jelajahi Produk
                </a>
            </div>
        </div>
    </section>

    
    <footer class="border-t border-slate-100 py-8 px-6">
        <div class="max-w-5xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-slate-400">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 bg-blue-600 rounded flex items-center justify-center">
                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <span class="font-semibold text-slate-600">Jual Lagih</span>
            </div>
            <p>© {{ date('Y') }} Jual Lagih. Semua hak dilindungi.</p>
            <div class="flex gap-5">
                <a href="#" class="hover:text-blue-500 transition-colors">Tentang</a>
                <a href="#" class="hover:text-blue-500 transition-colors">Bantuan</a>
                <a href="#" class="hover:text-blue-500 transition-colors">Privasi</a>
            </div>
        </div>
    </footer>

</body>
</html>

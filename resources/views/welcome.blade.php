<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jual Lagih – Premium Marketplace Barang Bekas</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass-nav { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); border-bottom: 1px solid rgba(226, 232, 240, 0.6); }
        .blob { position: absolute; filter: blur(80px); z-index: -1; opacity: 0.6; }
        .blob-1 { top: -10%; left: -10%; width: 40vw; height: 40vw; background: rgba(99, 102, 241, 0.3); border-radius: 50%; }
        .blob-2 { top: 20%; right: -10%; width: 35vw; height: 35vw; background: rgba(236, 72, 153, 0.2); border-radius: 50%; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased overflow-x-hidden relative">

    <!-- Decorative Background Globs -->
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <!-- Navbar -->
    <nav class="glass-nav fixed w-full top-0 z-50 transition-all duration-300">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-xl flex items-center justify-center transform group-hover:rotate-12 transition-transform duration-300 shadow-lg shadow-blue-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <span class="font-extrabold text-xl tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-blue-600">JualLagih.</span>
            </a>
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-indigo-600 transition-colors px-2">Masuk</a>
                <a href="{{ route('register') }}" class="text-sm font-semibold text-white bg-slate-900 hover:bg-slate-800 px-5 py-2.5 rounded-full transition-all hover:shadow-lg hover:shadow-slate-900/20 active:scale-95">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="max-w-6xl mx-auto px-6 pt-40 pb-24 text-center relative z-10">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-indigo-100 shadow-sm mb-8 animate-fade-in-up">
            <span class="flex h-2 w-2 relative">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
            </span>
            <span class="text-xs font-semibold text-indigo-700 tracking-wide uppercase">Marketplace Terpercaya 2026</span>
        </div>
        
        <h1 class="text-5xl sm:text-7xl font-extrabold text-slate-900 tracking-tight leading-tight mb-6">
            Jual & Beli Barang Bekas <br class="hidden sm:block">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-blue-500 to-purple-600">Lebih Cepat & Aman.</span>
        </h1>
        <p class="text-slate-500 text-lg sm:text-xl max-w-2xl mx-auto mb-12 font-medium">
            Temukan harta karun tersembunyi dengan harga miring. Dari elektronik hingga fashion, semua ada di sini.
        </p>

        <!-- Search Bar -->
        <div class="flex flex-col sm:flex-row gap-3 max-w-2xl mx-auto mb-16 relative">
            <div class="absolute inset-y-0 left-4 text-slate-400 flex items-center pointer-events-none">
                <svg class="w-6 h-6 z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input type="text"
                   placeholder="Cari laptop, sepatu, atau sofa..."
                   class="w-full pl-12 pr-4 py-4 rounded-2xl bg-white border-2 border-transparent shadow-xl shadow-indigo-100/50 text-slate-700 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all font-medium text-lg">
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white text-lg font-semibold px-8 py-4 rounded-2xl transition-all shadow-lg shadow-indigo-600/30 hover:-translate-y-0.5 active:scale-95 whitespace-nowrap">
                Cari Barang
            </button>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 max-w-3xl mx-auto border-y border-slate-200/60 py-8">
            <div class="flex flex-col items-center">
                <p class="text-4xl font-extrabold text-slate-900 tracking-tight">50K+</p>
                <p class="text-sm font-medium text-slate-500 mt-1">Produk Aktif</p>
            </div>
            <div class="flex flex-col items-center">
                <p class="text-4xl font-extrabold text-slate-900 tracking-tight">20K+</p>
                <p class="text-sm font-medium text-slate-500 mt-1">Pengguna Terdaftar</p>
            </div>
            <div class="flex flex-col items-center">
                <p class="text-4xl font-extrabold text-slate-900 tracking-tight flex items-center gap-1">
                    4.9<span class="text-2xl text-yellow-400">★</span>
                </p>
                <p class="text-sm font-medium text-slate-500 mt-1">Rating Kepuasan</p>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="max-w-6xl mx-auto px-6 py-20 z-10 relative">
        <div class="flex items-end justify-between mb-10 border-b border-slate-200/60 pb-6">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Eksplor Kategori</h2>
                <p class="text-slate-500 mt-2 font-medium">Temukan barang incaranmu dari berbagai macam kategori unggulan kami.</p>
            </div>
            <a href="#" class="hidden sm:inline-flex items-center gap-1 font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 sm:gap-6">
            <!-- Elektronik -->
            <a href="#" class="bg-white rounded-2xl p-6 flex flex-col items-center gap-4 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-indigo-100/60 border border-slate-100 group">
                <div class="w-14 h-14 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-500 group-hover:bg-indigo-500 group-hover:text-white transition-colors duration-300">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                    </svg>
                </div>
                <span class="font-semibold text-slate-700 group-hover:text-indigo-600 transition-colors">Elektronik</span>
            </a>
            <!-- Fashion -->
            <a href="#" class="bg-white rounded-2xl p-6 flex flex-col items-center gap-4 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-pink-100/60 border border-slate-100 group">
                <div class="w-14 h-14 bg-pink-50 rounded-xl flex items-center justify-center text-pink-500 group-hover:bg-pink-500 group-hover:text-white transition-colors duration-300">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                </div>
                <span class="font-semibold text-slate-700 group-hover:text-pink-600 transition-colors">Fashion</span>
            </a>
            <!-- Furnitur -->
            <a href="#" class="bg-white rounded-2xl p-6 flex flex-col items-center gap-4 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-amber-100/60 border border-slate-100 group">
                <div class="w-14 h-14 bg-amber-50 rounded-xl flex items-center justify-center text-amber-500 group-hover:bg-amber-500 group-hover:text-white transition-colors duration-300">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                    </svg>
                </div>
                <span class="font-semibold text-slate-700 group-hover:text-amber-600 transition-colors">Furnitur</span>
            </a>
            <!-- Otomotif -->
            <a href="#" class="bg-white rounded-2xl p-6 flex flex-col items-center gap-4 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-emerald-100/60 border border-slate-100 group">
                <div class="w-14 h-14 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-500 group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.25a2.25 2.25 0 0 0-2.25 2.25v1.5c0 1.242 1.008 2.25 2.25 2.25h2.25m-2.25-6h2.818c.205 0 .394.137.458.336a16.3 16.3 0 0 1 1.066 2.57 2.186 2.186 0 0 0 .584 1.076c.49.51.98 1.025 1.488 1.52.261.25.688.318 1.023.109A15.932 15.932 0 0 0 21.75 18M10.5 7.5H3.75a2.25 2.25 0 0 0-2.25 2.25v4.5a2.25 2.25 0 0 0 2.25 2.25h6.75a2.25 2.25 0 0 0 2.25-2.25V9.75a2.25 2.25 0 0 0-2.25-2.25Z" />
                    </svg>
                </div>
                <span class="font-semibold text-slate-700 group-hover:text-emerald-600 transition-colors">Otomotif</span>
            </a>
            <!-- Buku -->
            <a href="#" class="bg-white rounded-2xl p-6 flex flex-col items-center gap-4 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-cyan-100/60 border border-slate-100 group">
                <div class="w-14 h-14 bg-cyan-50 rounded-xl flex items-center justify-center text-cyan-500 group-hover:bg-cyan-500 group-hover:text-white transition-colors duration-300">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
                <span class="font-semibold text-slate-700 group-hover:text-cyan-600 transition-colors">Buku</span>
            </a>
            <!-- Rumah -->
            <a href="#" class="bg-white rounded-2xl p-6 flex flex-col items-center gap-4 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-purple-100/60 border border-slate-100 group">
                <div class="w-14 h-14 bg-purple-50 rounded-xl flex items-center justify-center text-purple-500 group-hover:bg-purple-500 group-hover:text-white transition-colors duration-300">
                    <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </div>
                <span class="font-semibold text-slate-700 group-hover:text-purple-600 transition-colors">Rumah</span>
            </a>
        </div>
    </section>

    <!-- How it Works section -->
    <section class="max-w-6xl mx-auto px-6 py-24 mb-10 z-10 relative">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Cara Kerja Sistem Kami</h2>
            <p class="text-slate-500 mt-2 font-medium max-w-xl mx-auto">Dirancang khusus agar siapapun bisa berjualan dan membeli dengan sangat instan dan aman.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="relative flex flex-col bg-white/70 backdrop-blur-sm p-8 rounded-[2rem] border border-slate-200/60 shadow-sm hover:shadow-xl hover:shadow-indigo-50/50 transition-all duration-300 hover:bg-white">
                <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center text-white font-bold text-xl mb-6 shadow-lg shadow-indigo-600/30">
                    1
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Daftar Akun</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Buat akun dengan form pendaftaran secara gratis dan cepat kurang dari 2 menit.</p>
            </div>
            
            <div class="relative flex flex-col bg-white/70 backdrop-blur-sm p-8 rounded-[2rem] border border-slate-200/60 shadow-sm hover:shadow-xl hover:shadow-blue-50/50 transition-all duration-300 md:translate-y-6 hover:bg-white">
                <div class="w-14 h-14 bg-blue-500 rounded-2xl flex items-center justify-center text-white font-bold text-xl mb-6 shadow-lg shadow-blue-500/30">
                    2
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Upload Barang</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Ambil foto terbaik barangmu, beri deskripsi lengkap, dan tentukan harga.</p>
            </div>
            
            <div class="relative flex flex-col bg-white/70 backdrop-blur-sm p-8 rounded-[2rem] border border-slate-200/60 shadow-sm hover:shadow-xl hover:shadow-purple-50/50 transition-all duration-300 hover:bg-white">
                <div class="w-14 h-14 bg-purple-500 rounded-2xl flex items-center justify-center text-white font-bold text-xl mb-6 shadow-lg shadow-purple-500/30">
                    3
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Terima Pesanan</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Tunggu notifikasi pesanan masuk, siapkan barang dan pastikan keamanan packing.</p>
            </div>
            
            <div class="relative flex flex-col bg-white/70 backdrop-blur-sm p-8 rounded-[2rem] border border-slate-200/60 shadow-sm hover:shadow-xl hover:shadow-pink-50/50 transition-all duration-300 md:translate-y-6 hover:bg-white">
                <div class="w-14 h-14 bg-pink-500 rounded-2xl flex items-center justify-center text-white font-bold text-xl mb-6 shadow-lg shadow-pink-500/30">
                    4
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Dapat Uang</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Kirim barangnya melalui kurir, dan uang seketika akan masuk ke saldomu.</p>
            </div>
        </div>
    </section>

    <!-- Super CTA -->
    <section class="max-w-5xl mx-auto px-6 pb-24 z-10 relative">
        <div class="bg-slate-900 rounded-[3rem] overflow-hidden relative shadow-2xl shadow-indigo-900/20">
            <!-- Decorative circle inside CTA -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full blur-3xl opacity-30 -translate-y-1/2 translate-x-1/3"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-tr from-blue-500 to-emerald-400 rounded-full blur-3xl opacity-20 translate-y-1/3 -translate-x-1/4"></div>
            
            <div class="relative z-10 px-8 py-20 sm:py-24 text-center">
                <h2 class="text-4xl sm:text-5xl font-extrabold text-white tracking-tight mb-6 mt-4">Siap Mulai Hari Ini?</h2>
                <p class="text-indigo-200 text-lg sm:text-xl font-medium max-w-2xl mx-auto mb-10">
                    Jangan tumpuk barang yang tidak terpakai. Ubah menjadi uang dengan pengalaman berjualan yang menyenangkan.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('register') }}" class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold text-lg px-8 py-4 rounded-2xl transition-all shadow-lg shadow-indigo-600/30 hover:-translate-y-0.5 active:scale-95 w-full sm:w-auto text-center">
                        Daftar Gratis Sekarang
                    </a>
                    <a href="#" class="bg-white/10 hover:bg-white/20 text-white font-medium text-lg px-8 py-4 rounded-2xl backdrop-blur-sm transition-all w-full sm:w-auto text-center border border-white/10">
                        Jelajahi Produk
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-slate-200 bg-white relative z-20">
        <div class="max-w-6xl mx-auto px-6 py-10 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-lg flex items-center justify-center shadow-sm">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <span class="font-extrabold text-lg text-slate-800 tracking-tight">JualLagih.</span>
            </div>
            
            <p class="text-slate-500 text-sm font-medium">© {{ date('Y') }} Jual Lagih. All rights reserved.</p>
            
            <div class="flex gap-6 text-sm font-medium">
                <a href="#" class="text-slate-500 hover:text-indigo-600 transition-colors">Tentang Kami</a>
                <a href="#" class="text-slate-500 hover:text-indigo-600 transition-colors">Privasi</a>
                <a href="#" class="text-slate-500 hover:text-indigo-600 transition-colors">Bantuan</a>
            </div>
        </div>
    </footer>

</body>
</html>

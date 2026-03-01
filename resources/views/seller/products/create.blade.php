@extends('seller.layouts.app')

@section('title', 'Tambah Produk')

@section('content')

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-xs text-gray-400 mb-6">
        <a href="{{ route('seller.products') }}" class="hover:text-blue-600 transition">Produk Saya</a>
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-600">Tambah Produk</span>
    </nav>

    <div class="max-w-2xl">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Tambah Produk Baru</h1>
            <p class="text-sm text-gray-500 mt-1">Isi detail produk yang ingin kamu jual</p>
        </div>

        @if($errors->any())
            <div class="mb-5 bg-red-50 border border-red-200 text-red-600 text-sm p-4 rounded-xl">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-blue-100 shadow-sm p-6">
            <form method="POST" action="{{ route('seller.products.store') }}" enctype="multipart/form-data"
                class="space-y-5">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Nama Produk <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm"
                        placeholder="Contoh: Kaos Polos Premium">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Deskripsi <span
                            class="text-red-500">*</span></label>
                    <textarea name="description" rows="4" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm resize-none"
                        placeholder="Jelaskan produkmu secara lengkap...">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Harga (Rp) <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="price" value="{{ old('price') }}" required min="0"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm"
                            placeholder="50000">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Stok <span
                                class="text-red-500">*</span></label>
                        <input type="number" name="stock" value="{{ old('stock') }}" required min="0"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm"
                            placeholder="100">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Foto Produk <span
                            class="text-red-500">*</span></label>
                    <div class="border-2 border-dashed border-blue-200 rounded-xl p-6 text-center hover:border-blue-400 transition cursor-pointer"
                        onclick="document.getElementById('image-input').click()">
                        <div id="preview-wrap" class="hidden mb-3">
                            <img id="image-preview" src="#" alt="Preview"
                                class="max-h-40 mx-auto rounded-lg object-contain">
                        </div>
                        <div id="upload-placeholder">
                            <svg class="w-10 h-10 text-blue-300 mx-auto mb-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-sm text-gray-500">Klik untuk pilih foto</p>
                            <p class="text-xs text-gray-400 mt-1">JPEG, PNG, GIF – Maks 2MB</p>
                        </div>
                        <input id="image-input" type="file" name="image" accept="image/*" class="hidden" required>
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition shadow-md text-sm flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Produk
                    </button>
                    <a href="{{ route('seller.products') }}"
                        class="px-5 py-3 border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium rounded-xl transition text-sm flex items-center">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        const input = document.getElementById('image-input');
        const preview = document.getElementById('image-preview');
        const previewWrap = document.getElementById('preview-wrap');
        const placeholder = document.getElementById('upload-placeholder');

        input.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    preview.src = e.target.result;
                    previewWrap.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
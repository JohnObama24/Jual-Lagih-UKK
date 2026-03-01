@extends('buyer.layouts.app')

@section('title', 'Profil Saya')

@section('content')

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Profil Saya</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola informasi akun dan keamananmu</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Avatar Card --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl border border-blue-100 p-6 shadow-sm text-center">
                <div
                    class="w-20 h-20 bg-linear-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-3 text-white text-3xl font-bold">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <h2 class="font-bold text-gray-800 text-lg">{{ $user->name }}</h2>
                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                <span
                    class="inline-block mt-2 bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full capitalize">
                    {{ $user->role }}
                </span>
                <div class="mt-4 pt-4 border-t border-blue-50 space-y-2 text-left">
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-4 h-4 text-blue-400 shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        {{ $user->no_hp ?? '-' }}
                    </div>
                    <div class="flex items-start gap-2 text-sm text-gray-600">
                        <svg class="w-4 h-4 text-blue-400 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="line-clamp-2">{{ $user->alamat ?? 'Belum diisi' }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Forms --}}
        <div class="lg:col-span-2 flex flex-col gap-5">

            {{-- Personal Info Form --}}
            <div class="bg-white rounded-2xl border border-blue-100 p-6 shadow-sm">
                <h3 class="text-base font-bold text-gray-800 mb-5 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Informasi Pribadi
                </h3>

                @if($errors->any() && !$errors->has('current_password'))
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-600 text-sm p-3 rounded-xl">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('buyer.profile.update') }}" class="space-y-4">
                    @csrf @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1.5">Nomor HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" required
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm"
                            placeholder="08123456789">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1.5">Alamat</label>
                        <textarea name="alamat" rows="3"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm resize-none"
                            placeholder="Alamat lengkap (opsional)">{{ old('alamat', $user->alamat) }}</textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2.5 rounded-xl transition shadow-sm text-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            {{-- Change Password Form --}}
            <div class="bg-white rounded-2xl border border-blue-100 p-6 shadow-sm">
                <h3 class="text-base font-bold text-gray-800 mb-5 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Ubah Password
                </h3>

                @if($errors->has('current_password'))
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-600 text-sm p-3 rounded-xl">
                        {{ $errors->first('current_password') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('buyer.profile.password') }}" class="space-y-4">
                    @csrf @method('PUT')

                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1.5">Password Saat Ini</label>
                        <input type="password" name="current_password" required
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm"
                            placeholder="••••••••">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Password Baru</label>
                            <input type="password" name="password" required
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm"
                                placeholder="Min. 8 karakter">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" required
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none text-sm"
                                placeholder="Ulangi password baru">
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2.5 rounded-xl transition shadow-sm text-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Ubah Password
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
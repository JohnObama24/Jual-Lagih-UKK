<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Jual Lagih</title>

    @vite('resources/css/app.css')

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-blue-50 min-h-screen flex items-center justify-center px-4 py-8">

    <div class="w-full max-w-lg">

        <div class="text-center mb-6">
            <h1 class="text-3xl font-semibold text-blue-600">Jual Lagih</h1>
            <p class="text-gray-500 text-sm mt-1">Buat akun baru</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 border border-blue-100">

            @if ($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 text-red-600 text-sm p-3 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.process') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Nama Lengkap</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                        placeholder="John Doe"
                    >
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                        placeholder="email@gmail.com"
                    >
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Daftar sebagai</label>
                    <select
                        name="role"
                        required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none bg-white"
                    >
                        <option value="">Pilih role</option>
                        <option value="buyer" {{ old('role') == 'buyer' ? 'selected' : '' }}>Pembeli</option>
                        <option value="seller" {{ old('role') == 'seller' ? 'selected' : '' }}>Penjual</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Nomor HP</label>
                    <input
                        type="text"
                        name="no_hp"
                        value="{{ old('no_hp') }}"
                        required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                        placeholder="08123456789"
                    >
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Alamat</label>
                    <textarea
                        name="alamat"
                        rows="2"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                        placeholder="Alamat lengkap (opsional)"
                    >{{ old('alamat') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Password</label>
                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                        placeholder="Minimal 8 karakter"
                    >
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Konfirmasi Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                        placeholder="Ulangi password"
                    >
                </div>

                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-xl shadow-md hover:shadow-lg transition"
                >
                    Daftar
                </button>

                <p class="text-center text-sm text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:text-blue-700">
                        Login
                    </a>
                </p>

            </form>

        </div>

        <p class="text-center text-xs text-gray-400 mt-6">
            © {{ date('Y') }} Jual Lagih. Semua hak dilindungi.
        </p>

    </div>

</body>
</html>

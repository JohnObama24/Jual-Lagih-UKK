<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Jual Lagih</title>

    @vite('resources/css/app.css')

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-blue-50 min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-md">

        <div class="text-center mb-6">
            <h1 class="text-3xl font-semibold text-blue-600">Jual Lagih</h1>
            <p class="text-gray-500 text-sm mt-1">Masuk ke akun Anda</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 border border-blue-100">

            @if(session('error'))
                <div class="mb-4 text-sm text-red-600 bg-red-50 border border-red-200 p-3 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.process') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}"
                        required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="email@gmail.com"
                    >
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Password</label>
                    <input 
                        type="password" 
                        name="password"
                        required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                        placeholder="••••••••"
                    >
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="accent-blue-600">
                        <span class="text-gray-600">Ingat saya</span>
                    </label>

                    <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">
                        Lupa password?
                    </a>
                </div>

                <button 
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-xl shadow-md hover:shadow-lg transition duration-200"
                >
                    Login
                </button>

                <p class="text-center text-sm text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-blue-600 font-medium hover:text-blue-700">
                        Daftar
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

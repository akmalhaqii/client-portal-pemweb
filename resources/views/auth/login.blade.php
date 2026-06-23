<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Client Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <div class="min-h-screen flex">
        
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-blue-600 to-indigo-900 justify-center items-center relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            
            <div class="relative z-10 text-center text-white px-12">
                <h1 class="text-5xl font-bold mb-6 tracking-tight">Client Portal</h1>
                <p class="text-lg text-blue-100 mb-8 max-w-md mx-auto">
                    Akses dashboard Anda untuk memantau proyek, mengelola tagihan, dan berkomunikasi dengan tim kami secara real-time.
                </p>
                <div class="flex justify-center space-x-4">
                    <span class="w-12 h-1 bg-white/30 rounded-full"></span>
                    <span class="w-3 h-1 bg-white/30 rounded-full"></span>
                    <span class="w-3 h-1 bg-white/30 rounded-full"></span>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 md:p-24 bg-white shadow-2xl lg:shadow-none z-20">
            <div class="w-full max-w-md">
                
                <div class="lg:hidden text-center mb-10">
                    <h2 class="text-3xl font-extrabold text-blue-700">Client Portal</h2>
                </div>

                <div class="mb-10">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang 👋</h2>
                    <p class="text-gray-500 text-sm">Silakan masukkan kredensial Anda untuk masuk ke akun Anda.</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm @error('email') border-red-500 ring-red-500 @enderror" 
                            placeholder="nama@perusahaan.com">
                        
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500 transition-colors">
                                    Lupa sandi?
                                </a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors shadow-sm @error('password') border-red-500 ring-red-500 @enderror" 
                            placeholder="••••••••">
                        
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded transition-colors">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-600">
                            Ingat saya selama 30 hari
                        </label>
                    </div>

                    <div>
                        <button type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-0.5">
                            Masuk ke Portal
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center text-sm text-gray-500">
                    <p>Mengalami kendala saat login? <a href="#" class="font-medium text-blue-600 hover:text-blue-500">Hubungi Dukungan IT</a></p>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
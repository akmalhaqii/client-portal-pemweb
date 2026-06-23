<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Client Portal') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-800 antialiased bg-slate-50 selection:bg-indigo-500 selection:text-white relative overflow-x-hidden">
        <!-- Background Decorations -->
        <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-gradient-to-b from-indigo-100/50 to-transparent blur-3xl rounded-full"></div>
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-violet-100/60 rounded-full blur-3xl"></div>
            <div class="absolute top-40 -left-40 w-96 h-96 bg-indigo-100/60 rounded-full blur-3xl"></div>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-8">
                <a href="/" class="flex flex-col items-center gap-3 hover:scale-105 transition-transform">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-600 flex items-center justify-center text-white font-bold text-3xl shadow-xl shadow-indigo-200">
                        CP
                    </div>
                    <span class="font-bold text-2xl tracking-tight text-slate-800">Client<span class="text-indigo-600">Portal</span></span>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-8 bg-white shadow-2xl shadow-indigo-100/50 border border-slate-100 sm:rounded-3xl relative overflow-hidden">
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-indigo-500 via-violet-500 to-indigo-500"></div>
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-sm text-slate-500 text-center">
                &copy; {{ date('Y') }} ClientPortal. Hak Cipta Dilindungi.
            </div>
        </div>
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Client Portal') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-800 selection:bg-indigo-500 selection:text-white">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-600 to-violet-600 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-indigo-200">
                        CP
                    </div>
                    <span class="font-bold text-xl tracking-tight text-slate-800">Client<span class="text-indigo-600">Portal</span></span>
                </div>
                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-slate-700 hover:text-indigo-600 transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-700 hover:text-indigo-600 transition-colors">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 text-sm font-semibold text-white bg-slate-900 hover:bg-slate-800 rounded-xl transition-all shadow-sm">
                                    Daftar Sekarang
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <!-- Background Decorations -->
        <div class="absolute inset-0 -z-10 bg-slate-50">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-[1000px] h-[500px] bg-gradient-to-b from-indigo-50/50 to-transparent blur-3xl rounded-full"></div>
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-violet-100/40 rounded-full blur-3xl"></div>
            <div class="absolute top-40 -left-40 w-96 h-96 bg-indigo-100/40 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative text-center">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white border border-slate-200 shadow-sm mb-8 animate-fade-in-up">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <span class="text-xs font-semibold text-slate-600 uppercase tracking-wider">Platform Manajemen Klien & Proyek</span>
            </div>

            <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight mb-8">
                Kelola Proyek dengan <br class="hidden md:block" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-violet-600 to-indigo-600 animate-gradient-x">Lebih Profesional</span>
            </h1>

            <p class="mt-4 max-w-2xl text-lg md:text-xl text-slate-600 mx-auto mb-10 leading-relaxed">
                Platform terpadu untuk memantau progress proyek, manajemen tugas, invoice, dan komunikasi klien dalam satu dashboard elegan.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl transition-all shadow-lg shadow-indigo-200 hover:shadow-indigo-300 hover:-translate-y-0.5">
                        Buka Dashboard
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl transition-all shadow-lg shadow-indigo-200 hover:shadow-indigo-300 hover:-translate-y-0.5">
                        Mulai Sekarang
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold text-slate-700 bg-white hover:bg-slate-50 border border-slate-200 rounded-xl transition-all shadow-sm hover:shadow-md hover:-translate-y-0.5">
                            Pelajari Lebih Lanjut
                        </a>
                    @endif
                @endauth
            </div>
            
            <div class="mt-20 relative mx-auto max-w-5xl">
                <div class="rounded-2xl border border-slate-200/60 bg-white/50 p-2 backdrop-blur-xl shadow-2xl overflow-hidden relative">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-50 to-transparent z-10 bottom-0 h-1/3"></div>
                    <div class="rounded-xl border border-slate-100 bg-slate-50 aspect-[16/9] flex items-center justify-center relative overflow-hidden">
                        <!-- Abstract Dashboard Mockup -->
                        <div class="absolute inset-0 bg-white">
                            <div class="h-12 border-b border-slate-100 flex items-center px-4 gap-4">
                                <div class="w-8 h-8 rounded-full bg-slate-100"></div>
                                <div class="w-32 h-4 rounded-full bg-slate-100"></div>
                            </div>
                            <div class="p-6 grid grid-cols-4 gap-6">
                                <div class="col-span-1 border-r border-slate-100 h-full space-y-4">
                                    <div class="w-full h-8 rounded-lg bg-indigo-50"></div>
                                    <div class="w-3/4 h-8 rounded-lg bg-slate-50"></div>
                                    <div class="w-5/6 h-8 rounded-lg bg-slate-50"></div>
                                </div>
                                <div class="col-span-3 space-y-6">
                                    <div class="grid grid-cols-3 gap-4">
                                        <div class="h-24 rounded-xl bg-slate-50 border border-slate-100 p-4">
                                            <div class="w-8 h-8 rounded-lg bg-indigo-100 mb-2"></div>
                                            <div class="w-16 h-4 rounded-full bg-slate-200"></div>
                                        </div>
                                        <div class="h-24 rounded-xl bg-slate-50 border border-slate-100 p-4">
                                            <div class="w-8 h-8 rounded-lg bg-violet-100 mb-2"></div>
                                            <div class="w-20 h-4 rounded-full bg-slate-200"></div>
                                        </div>
                                        <div class="h-24 rounded-xl bg-slate-50 border border-slate-100 p-4">
                                            <div class="w-8 h-8 rounded-lg bg-emerald-100 mb-2"></div>
                                            <div class="w-12 h-4 rounded-full bg-slate-200"></div>
                                        </div>
                                    </div>
                                    <div class="h-48 rounded-xl bg-slate-50 border border-slate-100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl font-bold text-slate-800 sm:text-4xl">Semua yang Anda butuhkan</h2>
                <p class="mt-4 text-lg text-slate-600">Sistem manajemen terintegrasi untuk agensi, freelancer, dan perusahaan modern.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Manajemen Proyek</h3>
                    <p class="text-slate-600">Pantau seluruh proyek klien dalam satu tampilan. Atur deadline, budget, dan status dengan mudah.</p>
                </div>

                <!-- Feature 2 -->
                <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-violet-100 text-violet-600 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Laporan Progress</h3>
                    <p class="text-slate-600">Berikan update berkala kepada klien secara real-time. Transparansi penuh untuk kepercayaan yang lebih baik.</p>
                </div>

                <!-- Feature 3 -->
                <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:shadow-lg transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Invoicing Otomatis</h3>
                    <p class="text-slate-600">Buat dan kelola tagihan proyek. Export ke PDF atau Excel dengan satu klik. Lacak pembayaran dengan akurat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 border-t border-slate-800 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center gap-3 mb-4 md:mb-0">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-violet-500 flex items-center justify-center text-white font-bold text-lg">
                        CP
                    </div>
                    <span class="font-bold text-xl tracking-tight text-white">Client<span class="text-indigo-400">Portal</span></span>
                </div>
                <div class="text-slate-400 text-sm">
                    &copy; {{ date('Y') }} ClientPortal. Hak Cipta Dilindungi.
                </div>
            </div>
        </div>
    </footer>

    <style>
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        .animate-gradient-x {
            background-size: 200% 200%;
            animation: gradient-x 4s ease infinite;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes gradient-x {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
    </style>
</body>
</html>

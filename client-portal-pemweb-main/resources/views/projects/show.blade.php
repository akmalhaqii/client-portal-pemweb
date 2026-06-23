<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center space-x-2 text-sm text-slate-500 mb-1">
                    <a href="{{ route('projects.index') }}" class="hover:text-indigo-600 transition-colors">Data Proyek</a>
                    <span>/</span>
                    <span class="text-slate-400">Detail</span>
                </div>
                <h2 class="font-bold text-2xl bg-gradient-to-r from-indigo-600 to-violet-600 text-transparent bg-clip-text leading-tight">
                    {{ $project->name }}
                </h2>
            </div>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('projects.edit', $project) }}" class="inline-flex items-center bg-white border border-slate-200 text-slate-700 px-4 py-2 rounded-xl hover:bg-slate-50 hover:text-indigo-600 transition-all shadow-sm text-sm font-medium">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Edit Proyek
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-lg shadow-sm flex justify-between items-center relative" x-transition>
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-emerald-700 font-medium">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-emerald-500 hover:text-emerald-700 transition-colors">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            @endif

            <!-- Overview Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden relative">
                <div class="absolute top-0 right-0 p-6 opacity-5 pointer-events-none text-indigo-900">
                    <svg class="w-48 h-48 -mr-10 -mt-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path></svg>
                </div>
                <div class="p-8">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-6">
                        <div class="flex-1 space-y-4">
                            <div>
                                <p class="text-sm font-medium text-slate-400 mb-1">Klien</p>
                                <p class="text-lg font-bold text-slate-800">{{ $project->client->name ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-400 mb-1">Deskripsi</p>
                                <p class="text-slate-600 leading-relaxed">{{ $project->description ?? 'Tidak ada deskripsi.' }}</p>
                            </div>
                        </div>
                        <div class="bg-slate-50 rounded-2xl p-6 border border-slate-100 w-full md:w-72 space-y-4">
                            <div>
                                <p class="text-xs font-medium text-slate-400 mb-1 uppercase tracking-wider">Status</p>
                                @php
                                    $color = match($project->status) {
                                        'completed' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                        'ongoing' => 'bg-indigo-100 text-indigo-700 border-indigo-200',
                                        'cancelled' => 'bg-rose-100 text-rose-700 border-rose-200',
                                        default => 'bg-slate-100 text-slate-700 border-slate-200',
                                    };
                                @endphp
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold border {{ $color }}">
                                    {{ ucfirst($project->status) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-slate-400 mb-1 uppercase tracking-wider">Budget</p>
                                <p class="font-bold text-slate-800">Rp {{ number_format($project->budget, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-slate-400 mb-1 uppercase tracking-wider">Deadline</p>
                                <p class="font-bold text-slate-800">{{ $project->deadline?->format('d M Y') ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100">
                        <div class="flex justify-between items-end mb-2">
                            <p class="text-sm font-bold text-slate-700">Progress Keseluruhan</p>
                            <p class="text-lg font-bold text-indigo-600">{{ $project->latestProgress() }}%</p>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-4 overflow-hidden">
                            <div class="bg-gradient-to-r from-indigo-500 to-violet-500 h-4 rounded-full transition-all duration-1000 ease-out relative" style="width: {{ $project->latestProgress() }}%">
                                <div class="absolute top-0 left-0 right-0 bottom-0 bg-white opacity-20" style="background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent); background-size: 1rem 1rem;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid Layout for Lists -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tasks -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col">
                    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <h3 class="font-bold text-slate-800 flex items-center">
                            <div class="p-2 bg-sky-100 text-sky-600 rounded-lg mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            Tugas (Tasks)
                        </h3>
                        <a href="{{ route('projects.tasks.index', $project) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">Kelola &rarr;</a>
                    </div>
                    <ul class="divide-y divide-slate-100 flex-1">
                        @forelse ($project->tasks->take(5) as $task)
                            <li class="p-4 hover:bg-slate-50 transition-colors flex justify-between items-center">
                                <span class="font-medium text-slate-700">{{ $task->title }}</span>
                                @php
                                    $tColor = match($task->status) {
                                        'done' => 'bg-emerald-100 text-emerald-700',
                                        'in_progress' => 'bg-amber-100 text-amber-700',
                                        default => 'bg-slate-100 text-slate-700',
                                    };
                                @endphp
                                <span class="px-2.5 py-1 rounded-full text-[10px] uppercase tracking-wider font-bold {{ $tColor }}">{{ str_replace('_', ' ', $task->status) }}</span>
                            </li>
                        @empty
                            <li class="p-8 text-center text-slate-400">
                                <svg class="w-10 h-10 mx-auto text-slate-200 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                Belum ada tugas.
                            </li>
                        @endforelse
                    </ul>
                </div>

                <!-- Progress Reports -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col">
                    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <h3 class="font-bold text-slate-800 flex items-center">
                            <div class="p-2 bg-emerald-100 text-emerald-600 rounded-lg mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            </div>
                            Laporan Progress
                        </h3>
                        <a href="{{ route('projects.progress.index', $project) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">Kelola &rarr;</a>
                    </div>
                    <ul class="divide-y divide-slate-100 flex-1">
                        @forelse ($project->progressReports->take(5) as $report)
                            <li class="p-4 hover:bg-slate-50 transition-colors flex justify-between items-center">
                                <span class="font-medium text-slate-700 truncate pr-4">{{ $report->description ?? 'Pembaruan Progress' }}</span>
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-indigo-50 text-indigo-600 border border-indigo-100">{{ $report->percentage }}%</span>
                            </li>
                        @empty
                            <li class="p-8 text-center text-slate-400">
                                <svg class="w-10 h-10 mx-auto text-slate-200 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                Belum ada laporan.
                            </li>
                        @endforelse
                    </ul>
                </div>

                <!-- Invoices (Spans full width if needed, or 1 col) -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden md:col-span-2">
                    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <h3 class="font-bold text-slate-800 flex items-center">
                            <div class="p-2 bg-amber-100 text-amber-600 rounded-lg mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            Invoice Terkait
                        </h3>
                        <a href="{{ route('invoices.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">Lihat Semua &rarr;</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($project->invoices->take(5) as $invoice)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="py-4 px-6 font-medium text-slate-800">
                                            Rp {{ number_format($invoice->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="py-4 px-6 text-slate-500">
                                            {{ $invoice->invoice_date->format('d M Y') }}
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            @php
                                                $iColor = match($invoice->status) {
                                                    'paid' => 'bg-emerald-100 text-emerald-700',
                                                    'unpaid' => 'bg-rose-100 text-rose-700',
                                                    default => 'bg-slate-100 text-slate-700',
                                                };
                                            @endphp
                                            <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider {{ $iColor }}">{{ $invoice->status }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-8 text-center text-slate-400">
                                            <svg class="w-10 h-10 mx-auto text-slate-200 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                            Belum ada invoice.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-center">
                <a href="{{ route('projects.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full shadow-sm text-indigo-700 bg-indigo-100 hover:bg-indigo-200 transition-colors focus:outline-none">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar Proyek
                </a>
            </div>

        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl bg-gradient-to-r from-indigo-600 to-violet-600 text-transparent bg-clip-text leading-tight">
            Dashboard Saya
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Projects -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-center space-x-4 hover:shadow-md transition-shadow duration-300">
                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Proyek Saya</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $totalProjects }}</p>
                    </div>
                </div>

                <!-- Avg Progress -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-center space-x-4 hover:shadow-md transition-shadow duration-300">
                    <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Rata-rata Progress</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $avgProgress }}%</p>
                    </div>
                </div>

                <!-- Tasks Done -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-center space-x-4 hover:shadow-md transition-shadow duration-300">
                    <div class="p-3 bg-sky-50 text-sky-600 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Tugas Selesai</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $totalTasksDone }} <span class="text-sm text-slate-400 font-normal">/ {{ $totalTasks }}</span></p>
                    </div>
                </div>

                <!-- Total Invoices -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex items-center space-x-4 hover:shadow-md transition-shadow duration-300">
                    <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Invoice</p>
                        <p class="text-2xl font-bold text-slate-800">{{ $totalInvoices }}</p>
                    </div>
                </div>
            </div>

            <!-- Financial Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Paid -->
                <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl shadow-md p-6 text-white relative overflow-hidden">
                    <svg class="absolute right-0 bottom-0 w-32 h-32 text-white opacity-10 transform translate-x-8 translate-y-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-emerald-100 font-medium">Sudah Dibayar</p>
                    <p class="text-3xl font-bold mt-1">Rp {{ number_format($totalPaid, 0, ',', '.') }}</p>
                </div>
                <!-- Unpaid -->
                <div class="bg-gradient-to-br from-rose-500 to-red-600 rounded-2xl shadow-md p-6 text-white relative overflow-hidden">
                    <svg class="absolute right-0 bottom-0 w-32 h-32 text-white opacity-10 transform translate-x-8 translate-y-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p class="text-rose-100 font-medium">Belum Dibayar</p>
                    <p class="text-3xl font-bold mt-1">Rp {{ number_format($totalUnpaid, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- My Projects -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                    <h3 class="font-bold text-lg text-slate-800">Daftar Proyek</h3>
                    <a href="{{ route('projects.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">Lihat Semua &rarr;</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-slate-50 text-slate-500">
                            <tr>
                                <th class="py-3 px-6 font-medium">Nama Proyek</th>
                                <th class="py-3 px-6 font-medium">Status</th>
                                <th class="py-3 px-6 font-medium">Deadline</th>
                                <th class="py-3 px-6 font-medium">Progress</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($myProjects as $project)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="py-4 px-6">
                                        <a href="{{ route('projects.show', $project) }}" class="font-medium text-slate-800 hover:text-indigo-600 transition-colors">{{ $project->name }}</a>
                                    </td>
                                    <td class="py-4 px-6">
                                        @php
                                            $color = match($project->status) {
                                                'completed' => 'bg-emerald-100 text-emerald-700',
                                                'ongoing' => 'bg-indigo-100 text-indigo-700',
                                                'cancelled' => 'bg-rose-100 text-rose-700',
                                                default => 'bg-slate-100 text-slate-700',
                                            };
                                        @endphp
                                        <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $color }}">
                                            {{ ucfirst($project->status) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-slate-600">
                                        {{ $project->deadline?->format('d M Y') ?? '-' }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <div class="flex items-center space-x-3">
                                            <span class="text-slate-600 font-medium">{{ $project->latestProgress() }}%</span>
                                            <div class="w-24 h-2 bg-slate-100 rounded-full overflow-hidden">
                                                <div class="h-full bg-indigo-500 rounded-full" style="width: {{ $project->latestProgress() }}%"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-center text-slate-500">Belum ada proyek.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

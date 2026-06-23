<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center space-x-2 text-sm text-slate-500 mb-1">
                    <a href="{{ route('clients.index') }}" class="hover:text-indigo-600 transition-colors">Data Klien</a>
                    <span>/</span>
                    <span class="text-slate-400">Detail</span>
                </div>
                <h2 class="font-bold text-2xl bg-gradient-to-r from-indigo-600 to-violet-600 text-transparent bg-clip-text leading-tight">
                    {{ $client->name }}
                </h2>
            </div>
            <a href="{{ route('clients.edit', $client) }}" class="inline-flex items-center bg-white border border-slate-200 text-slate-700 px-4 py-2 rounded-xl hover:bg-slate-50 hover:text-indigo-600 transition-all shadow-sm text-sm font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Edit Klien
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Detail Klien -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden relative">
                <div class="absolute top-0 right-0 p-6 opacity-5 pointer-events-none text-indigo-900">
                    <svg class="w-48 h-48 -mr-10 -mt-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div class="p-8">
                    <div class="flex items-center space-x-6 mb-8">
                        <div class="h-20 w-20 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-4xl font-bold shadow-sm border border-indigo-100">
                            {{ substr($client->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-slate-800">{{ $client->name }}</h3>
                            <p class="text-slate-500 font-medium">{{ $client->company ?? 'Tidak ada perusahaan' }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-slate-50 p-6 rounded-2xl border border-slate-100">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1 flex items-center"><svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg> Telepon</p>
                            <p class="text-slate-800 font-medium">{{ $client->phone ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1 flex items-center"><svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> Alamat</p>
                            <p class="text-slate-800 font-medium">{{ $client->address ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Proyek Terkait -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="font-bold text-slate-800 flex items-center">
                        <div class="p-2 bg-indigo-100 text-indigo-600 rounded-lg mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        Proyek Terkait
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-slate-50 text-slate-500 border-b border-slate-100">
                            <tr>
                                <th class="py-4 px-6 font-medium">Nama Proyek</th>
                                <th class="py-4 px-6 font-medium">Status</th>
                                <th class="py-4 px-6 font-medium">Budget</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($client->projects as $project)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="py-4 px-6">
                                        <a href="{{ route('projects.show', $project) }}" class="font-medium text-slate-800 hover:text-indigo-600 transition-colors">{{ $project->name }}</a>
                                    </td>
                                    <td class="py-4 px-6">
                                        @php
                                            $color = match($project->status) {
                                                'completed' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                                'ongoing' => 'bg-indigo-100 text-indigo-700 border-indigo-200',
                                                'cancelled' => 'bg-rose-100 text-rose-700 border-rose-200',
                                                default => 'bg-slate-100 text-slate-700 border-slate-200',
                                            };
                                        @endphp
                                        <span class="px-2.5 py-1 rounded-full text-[10px] uppercase tracking-wider font-bold border {{ $color }}">
                                            {{ ucfirst($project->status) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 font-medium text-slate-700">
                                        Rp {{ number_format($project->budget, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="py-8 text-center text-slate-500">
                                        <svg class="w-10 h-10 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                        Belum ada proyek untuk klien ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4 flex justify-center">
                <a href="{{ route('clients.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full shadow-sm text-indigo-700 bg-indigo-100 hover:bg-indigo-200 transition-colors focus:outline-none">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar Klien
                </a>
            </div>
            
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center space-x-2 text-sm text-slate-500 mb-1">
                    <a href="{{ route('projects.index') }}" class="hover:text-indigo-600 transition-colors">Data Proyek</a>
                    <span>/</span>
                    <a href="{{ route('projects.show', $project) }}" class="hover:text-indigo-600 transition-colors">{{ $project->name }}</a>
                    <span>/</span>
                    <span class="text-slate-400">Tugas</span>
                </div>
                <h2 class="font-bold text-2xl bg-gradient-to-r from-indigo-600 to-violet-600 text-transparent bg-clip-text leading-tight">
                    Daftar Tugas
                </h2>
            </div>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('projects.tasks.create', $project) }}" class="inline-flex items-center bg-indigo-600 text-white px-4 py-2 rounded-xl hover:bg-indigo-700 transition-all shadow-sm shadow-indigo-200 text-sm font-medium">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Tugas
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

            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-slate-50 text-slate-500 border-b border-slate-100">
                            <tr>
                                <th class="py-4 px-6 font-medium">Judul Tugas</th>
                                <th class="py-4 px-6 font-medium">Status</th>
                                <th class="py-4 px-6 font-medium">Deadline</th>
                                <th class="py-4 px-6 font-medium text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($tasks as $task)
                                <tr class="hover:bg-slate-50 transition-colors group">
                                    <td class="py-4 px-6 font-medium text-slate-800">{{ $task->title }}</td>
                                    <td class="py-4 px-6">
                                        @php
                                            $tColor = match($task->status) {
                                                'done' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                                'in_progress' => 'bg-amber-100 text-amber-700 border-amber-200',
                                                default => 'bg-slate-100 text-slate-700 border-slate-200',
                                            };
                                        @endphp
                                        <span class="px-2.5 py-1 rounded-full text-[10px] uppercase tracking-wider font-bold border {{ $tColor }}">
                                            {{ str_replace('_', ' ', $task->status) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-slate-600">{{ $task->deadline?->format('d M Y') ?? '-' }}</td>
                                    <td class="py-4 px-6 text-right">
                                        <div class="flex justify-end items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                            @if (auth()->user()->isAdmin())
                                                <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors tooltip" title="Edit">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </a>
                                                <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus tugas ini?')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition-colors tooltip" title="Hapus">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-slate-400">-</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-center text-slate-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                            <p>Belum ada tugas untuk proyek ini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($tasks->hasPages())
                <div class="px-6 py-4 border-t border-slate-100">
                    {{ $tasks->links() }}
                </div>
                @endif
            </div>
            
            <div class="mt-4 flex justify-center">
                <a href="{{ route('projects.show', $project) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full shadow-sm text-indigo-700 bg-indigo-100 hover:bg-indigo-200 transition-colors focus:outline-none">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Detail Proyek
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

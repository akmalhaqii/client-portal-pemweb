@if (auth()->user()->isAdmin())
<table class="w-full text-sm text-left">
    <thead class="bg-slate-50 text-slate-500 border-b border-slate-100">
        <tr>
            <th class="py-4 px-6 font-medium">Nama Proyek</th>
            <th class="py-4 px-6 font-medium">Klien</th>
            <th class="py-4 px-6 font-medium">Status</th>
            <th class="py-4 px-6 font-medium">Progress</th>
            <th class="py-4 px-6 font-medium">Deadline</th>
            <th class="py-4 px-6 font-medium text-right">Aksi</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-slate-100">
        @forelse ($projects as $project)
            <tr class="hover:bg-slate-50 transition-colors group">
                <td class="py-4 px-6 font-medium text-slate-800">{{ $project->name }}</td>
                <td class="py-4 px-6 text-slate-600">{{ $project->client->name ?? '-' }}</td>
                <td class="py-4 px-6">
                    @php
                        $color = match($project->status) {
                            'completed' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                            'ongoing'   => 'bg-indigo-100 text-indigo-700 border-indigo-200',
                            'cancelled' => 'bg-rose-100 text-rose-700 border-rose-200',
                            default     => 'bg-slate-100 text-slate-700 border-slate-200',
                        };
                    @endphp
                    <span class="px-2.5 py-1 rounded-full text-xs font-medium border {{ $color }}">
                        {{ ucfirst($project->status) }}
                    </span>
                </td>
                <td class="py-4 px-6">
                    <div class="flex items-center space-x-3">
                        <span class="text-slate-600 font-medium w-8">{{ $project->latestProgress() }}%</span>
                        <div class="w-24 h-2 bg-slate-200 rounded-full overflow-hidden">
                            <div class="h-full bg-indigo-500 rounded-full" style="width: {{ $project->latestProgress() }}%"></div>
                        </div>
                    </div>
                </td>
                <td class="py-4 px-6 text-slate-600">{{ $project->deadline?->format('d M Y') ?? '-' }}</td>
                <td class="py-4 px-6 text-right">
                    <div class="flex justify-end items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <a href="{{ route('projects.show', $project) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" title="Lihat">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </a>
                        <a href="{{ route('projects.edit', $project) }}" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline" onsubmit="return confirm('Hapus proyek ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="py-8 text-center text-slate-500">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                        <p>Tidak ada data proyek.</p>
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
@endif

@if (auth()->user()->isClient())
    <div class="border-b border-slate-100 last:border-0">
        <h1>HAYIIIII BIBUBBBBBB</h1>
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 px-6 py-4 bg-slate-50">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-indigo-100 text-indigo-600 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                </div>
                <div>
                    <p class="font-semibold text-slate-800">{{ $project->name }}</p>
                    <p class="text-xs text-slate-400">Deadline: {{ $project->deadline?->format('d M Y') ?? '-' }}</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                @php
                    $color = match($project->status) {
                        'completed' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                        'ongoing'   => 'bg-indigo-100 text-indigo-700 border-indigo-200',
                        'cancelled' => 'bg-rose-100 text-rose-700 border-rose-200',
                        default     => 'bg-slate-100 text-slate-700 border-slate-200',
                    };
                @endphp
                <span class="px-2.5 py-1 rounded-full text-xs font-medium border {{ $color }}">
                    {{ ucfirst($project->status) }}
                </span>
                <div class="flex items-center gap-2 min-w-[120px]">
                    <div class="w-20 h-2 bg-slate-200 rounded-full overflow-hidden">
                        <div class="h-full bg-indigo-500 rounded-full" style="width: {{ $project->latestProgress() }}%"></div>
                    </div>
                    <span class="text-xs font-medium text-slate-600">{{ $project->latestProgress() }}%</span>
                </div>
                <a href="{{ route('projects.show', $project) }}" class="p-2 text-indigo-600 hover:bg-indigo-100 rounded-lg transition-colors" title="Lihat Detail">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </a>
            </div>
        </div>

        <table class="w-full text-sm text-left">
            <thead class="text-slate-400 text-xs uppercase">
                <tr>
                    <th class="py-2 px-6 font-medium pl-14">Nama Tugas</th>
                    <th class="py-2 px-6 font-medium">Status</th>
                    <th class="py-2 px-6 font-medium">Deadline</th>
                    <th class="py-2 px-6 font-medium">Catatan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse ($project->tasks as $task)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-3 px-6 pl-14 text-slate-700">
                            <div class="flex items-center gap-2">
                                @if ($task->status === 'done')
                                    <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                @else
                                    <svg class="w-4 h-4 text-slate-300 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                @endif
                                {{ $task->name }}
                            </div>
                        </td>
                        <td class="py-3 px-6">
                            @php
                                $taskColor = match($task->status) {
                                    'done'        => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                    'in_progress' => 'bg-sky-100 text-sky-700 border-sky-200',
                                    'pending'     => 'bg-amber-100 text-amber-700 border-amber-200',
                                    default       => 'bg-slate-100 text-slate-600 border-slate-200',
                                };
                            @endphp
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium border {{ $taskColor }}">
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>
                        </td>
                        <td class="py-3 px-6 text-slate-500">
                            {{ $task->deadline?->format('d M Y') ?? '-' }}
                        </td>
                        <td class="py-3 px-6 text-slate-400 max-w-xs truncate">
                            {{ $task->notes ?? '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 pl-14 text-slate-400 text-xs italic">
                            Belum ada tugas pada proyek ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@empty
    <div class="py-12 text-center text-slate-500">
        <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
        <p>Tidak ada proyek yang di-assign ke Anda.</p>
    </div>
@endforelse

@endif

<div class="px-6 py-4 border-t border-slate-100">
    {{ $projects->links() }}
</div>

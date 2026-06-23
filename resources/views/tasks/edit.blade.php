<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center space-x-2 text-sm text-slate-500 mb-1">
                    <a href="{{ route('projects.index') }}" class="hover:text-indigo-600 transition-colors">Data Proyek</a>
                    <span>/</span>
                    <a href="{{ route('projects.show', $project) }}" class="hover:text-indigo-600 transition-colors">{{ $project->name }}</a>
                    <span>/</span>
                    <a href="{{ route('projects.tasks.index', $project) }}" class="hover:text-indigo-600 transition-colors">Tugas</a>
                    <span>/</span>
                    <span class="text-slate-400">Edit</span>
                </div>
                <h2 class="font-bold text-2xl bg-gradient-to-r from-indigo-600 to-violet-600 text-transparent bg-clip-text leading-tight">
                    Edit Tugas
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 sm:p-8">
                    <form action="{{ route('projects.tasks.update', [$project, $task]) }}" method="POST" class="space-y-6">
                        @csrf @method('PUT')

                        <div class="space-y-1">
                            <label class="block text-sm font-semibold text-slate-700">Judul Tugas <span class="text-rose-500">*</span></label>
                            <input type="text" name="title" value="{{ old('title', $task->title) }}" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors bg-slate-50/50 hover:bg-white focus:bg-white">
                            @error('title') <p class="text-rose-500 text-sm mt-1 flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-semibold text-slate-700">Deskripsi</label>
                            <textarea name="description" rows="4" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors bg-slate-50/50 hover:bg-white focus:bg-white">{{ old('description', $task->description) }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="space-y-1">
                                <label class="block text-sm font-semibold text-slate-700">Status</label>
                                <select name="status" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors cursor-pointer bg-slate-50/50 hover:bg-white">
                                    @foreach (['todo' => 'To Do', 'in_progress' => 'In Progress', 'done' => 'Done'] as $value => $label)
                                        <option value="{{ $value }}" @selected(old('status', $task->status) == $value)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-1">
                                <label class="block text-sm font-semibold text-slate-700">Deadline</label>
                                <input type="date" name="deadline" value="{{ old('deadline', $task->deadline?->format('Y-m-d')) }}" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors cursor-pointer bg-slate-50/50 hover:bg-white">
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                            <a href="{{ route('projects.tasks.index', $project) }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 hover:text-slate-800 transition-colors focus:outline-none focus:ring-2 focus:ring-slate-200 focus:ring-offset-1">Batal</a>
                            <button type="submit" class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white font-medium hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                Update Tugas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center space-x-2 text-sm text-slate-500 mb-1">
                    <a href="{{ route('projects.index') }}" class="hover:text-indigo-600 transition-colors">Data Proyek</a>
                    <span>/</span>
                    <span class="text-slate-400">Tambah Baru</span>
                </div>
                <h2 class="font-bold text-2xl bg-gradient-to-r from-indigo-600 to-violet-600 text-transparent bg-clip-text leading-tight">
                    Tambah Proyek
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 sm:p-8">
                    <form action="{{ route('projects.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="space-y-1">
                            <label class="block text-sm font-semibold text-slate-700">Klien <span class="text-rose-500">*</span></label>
                            <select name="client_id" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors cursor-pointer bg-slate-50/50 hover:bg-white">
                                <option value="">-- Pilih Klien --</option>
                                @foreach ($clients as $client)
                                    <option value="{{ $client->id }}" @selected(old('client_id') == $client->id)>{{ $client->name }}</option>
                                @endforeach
                            </select>
                            @error('client_id') <p class="text-rose-500 text-sm mt-1 flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-semibold text-slate-700">Nama Proyek <span class="text-rose-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Pembuatan Website E-Commerce" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors bg-slate-50/50 hover:bg-white focus:bg-white">
                            @error('name') <p class="text-rose-500 text-sm mt-1 flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-semibold text-slate-700">Deskripsi</label>
                            <textarea name="description" rows="4" placeholder="Jelaskan detail proyek ini..." class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors bg-slate-50/50 hover:bg-white focus:bg-white">{{ old('description') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="space-y-1">
                                <label class="block text-sm font-semibold text-slate-700">Budget (Rp) <span class="text-rose-500">*</span></label>
                                <div class="relative mt-1 rounded-xl shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                        <span class="text-slate-500 sm:text-sm font-medium">Rp</span>
                                    </div>
                                    <input type="number" step="0.01" name="budget" value="{{ old('budget') }}" placeholder="0.00" class="block w-full rounded-xl border-slate-200 pl-11 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors bg-slate-50/50 hover:bg-white focus:bg-white">
                                </div>
                                @error('budget') <p class="text-rose-500 text-sm mt-1 flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-1">
                                <label class="block text-sm font-semibold text-slate-700">Deadline</label>
                                <input type="date" name="deadline" value="{{ old('deadline') }}" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors cursor-pointer bg-slate-50/50 hover:bg-white">
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-semibold text-slate-700">Status</label>
                            <select name="status" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors cursor-pointer bg-slate-50/50 hover:bg-white">
                                <option value="planning">Planning</option>
                                <option value="ongoing">Ongoing</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                            <a href="{{ route('projects.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 hover:text-slate-800 transition-colors focus:outline-none focus:ring-2 focus:ring-slate-200 focus:ring-offset-1">Batal</a>
                            <button type="submit" class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white font-medium hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Simpan Proyek
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

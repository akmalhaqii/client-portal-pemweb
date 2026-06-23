<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center space-x-2 text-sm text-slate-500 mb-1">
                    <a href="{{ route('invoices.index') }}" class="hover:text-indigo-600 transition-colors">Data Invoice</a>
                    <span>/</span>
                    <span class="text-slate-400">Tambah Baru</span>
                </div>
                <h2 class="font-bold text-2xl bg-gradient-to-r from-indigo-600 to-violet-600 text-transparent bg-clip-text leading-tight">
                    Tambah Invoice
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 sm:p-8">
                    <form action="{{ route('invoices.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="space-y-1">
                            <label class="block text-sm font-semibold text-slate-700">Proyek <span class="text-rose-500">*</span></label>
                            <select name="project_id" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors cursor-pointer bg-slate-50/50 hover:bg-white">
                                <option value="">-- Pilih Proyek --</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" @selected(old('project_id') == $project->id)>{{ $project->name }}</option>
                                @endforeach
                            </select>
                            @error('project_id') <p class="text-rose-500 text-sm mt-1 flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="space-y-1">
                                <label class="block text-sm font-semibold text-slate-700">Jumlah (Rp) <span class="text-rose-500">*</span></label>
                                <div class="relative mt-1 rounded-xl shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                        <span class="text-slate-500 sm:text-sm font-medium">Rp</span>
                                    </div>
                                    <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" placeholder="0.00" class="block w-full rounded-xl border-slate-200 pl-11 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors bg-slate-50/50 hover:bg-white focus:bg-white">
                                </div>
                                @error('amount') <p class="text-rose-500 text-sm mt-1 flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-1">
                                <label class="block text-sm font-semibold text-slate-700">Status</label>
                                <select name="status" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors cursor-pointer bg-slate-50/50 hover:bg-white">
                                    <option value="unpaid">Unpaid</option>
                                    <option value="paid">Paid</option>
                                    <option value="overdue">Overdue</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-semibold text-slate-700">Tanggal Invoice <span class="text-rose-500">*</span></label>
                            <input type="date" name="invoice_date" value="{{ old('invoice_date') }}" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors cursor-pointer bg-slate-50/50 hover:bg-white">
                            @error('invoice_date') <p class="text-rose-500 text-sm mt-1 flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p> @enderror
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                            <a href="{{ route('invoices.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 hover:text-slate-800 transition-colors focus:outline-none focus:ring-2 focus:ring-slate-200 focus:ring-offset-1">Batal</a>
                            <button type="submit" class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white font-medium hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Simpan Invoice
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

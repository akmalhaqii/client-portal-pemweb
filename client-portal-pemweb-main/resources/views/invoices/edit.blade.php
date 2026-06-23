<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center space-x-2 text-sm text-slate-500 mb-1">
                    <a href="{{ route('invoices.index') }}" class="hover:text-indigo-600 transition-colors">Data Invoice</a>
                    <span>/</span>
                    <span class="text-slate-400">Edit</span>
                </div>
                <h2 class="font-bold text-2xl bg-gradient-to-r from-indigo-600 to-violet-600 text-transparent bg-clip-text leading-tight">
                    Edit Invoice
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 sm:p-8">
                    <form action="{{ route('invoices.update', $invoice) }}" method="POST" class="space-y-6">
                        @csrf @method('PUT')

                        <div class="space-y-1">
                            <label class="block text-sm font-semibold text-slate-700">Proyek <span class="text-rose-500">*</span></label>
                            <select name="project_id" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors cursor-pointer bg-slate-50/50 hover:bg-white">
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" @selected(old('project_id', $invoice->project_id) == $project->id)>{{ $project->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="space-y-1">
                                <label class="block text-sm font-semibold text-slate-700">Jumlah (Rp) <span class="text-rose-500">*</span></label>
                                <div class="relative mt-1 rounded-xl shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                                        <span class="text-slate-500 sm:text-sm font-medium">Rp</span>
                                    </div>
                                    <input type="number" step="0.01" name="amount" value="{{ old('amount', $invoice->amount) }}" class="block w-full rounded-xl border-slate-200 pl-11 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors bg-slate-50/50 hover:bg-white focus:bg-white">
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label class="block text-sm font-semibold text-slate-700">Status</label>
                                <select name="status" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors cursor-pointer bg-slate-50/50 hover:bg-white">
                                    @foreach (['unpaid' => 'Unpaid', 'paid' => 'Paid', 'overdue' => 'Overdue'] as $val => $label)
                                        <option value="{{ $val }}" @selected(old('status', $invoice->status) == $val)>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="block text-sm font-semibold text-slate-700">Tanggal Invoice <span class="text-rose-500">*</span></label>
                            <input type="date" name="invoice_date" value="{{ old('invoice_date', $invoice->invoice_date->format('Y-m-d')) }}" class="mt-1 block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-colors cursor-pointer bg-slate-50/50 hover:bg-white">
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                            <a href="{{ route('invoices.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-medium hover:bg-slate-50 hover:text-slate-800 transition-colors focus:outline-none focus:ring-2 focus:ring-slate-200 focus:ring-offset-1">Batal</a>
                            <button type="submit" class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white font-medium hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                Update Invoice
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

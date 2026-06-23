<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Invoice</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('invoices.update', $invoice) }}" method="POST" class="space-y-4">
                    @csrf @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Proyek</label>
                        <select name="project_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}" @selected(old('project_id', $invoice->project_id) == $project->id)>{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah (Rp)</label>
                        <input type="number" step="0.01" name="amount" value="{{ old('amount', $invoice->amount) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @foreach (['unpaid', 'paid', 'overdue'] as $s)
                                <option value="{{ $s }}" @selected(old('status', $invoice->status) == $s)>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Invoice</label>
                        <input type="date" name="invoice_date" value="{{ old('invoice_date', $invoice->invoice_date->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('invoices.index') }}" class="px-4 py-2 rounded-md border">Batal</a>
                        <button type="submit" class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

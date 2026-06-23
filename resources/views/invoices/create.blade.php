<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Invoice</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('invoices.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Proyek</label>
                        <select name="project_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">-- Pilih Proyek --</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}" @selected(old('project_id') == $project->id)>{{ $project->name }}</option>
                            @endforeach
                        </select>
                        @error('project_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jumlah (Rp)</label>
                        <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('amount') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="unpaid">Unpaid</option>
                            <option value="paid">Paid</option>
                            <option value="overdue">Overdue</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Invoice</label>
                        <input type="date" name="invoice_date" value="{{ old('invoice_date') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('invoice_date') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('invoices.index') }}" class="px-4 py-2 rounded-md border">Batal</a>
                        <button type="submit" class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

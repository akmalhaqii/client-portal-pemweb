<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Laporan Progress - {{ $project->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('projects.progress.store', $project) }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Persentase (%)</label>
                        <input type="number" min="0" max="100" name="percentage" value="{{ old('percentage') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('percentage') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description') }}</textarea>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('projects.progress.index', $project) }}" class="px-4 py-2 rounded-md border">Batal</a>
                        <button type="submit" class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

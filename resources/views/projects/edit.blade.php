<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Proyek</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('projects.update', $project) }}" method="POST" class="space-y-4">
                    @csrf @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Klien</label>
                        <select name="client_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}" @selected(old('client_id', $project->client_id) == $client->id)>{{ $client->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Proyek</label>
                        <input type="text" name="name" value="{{ old('name', $project->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description', $project->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Budget (Rp)</label>
                            <input type="number" step="0.01" name="budget" value="{{ old('budget', $project->budget) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Deadline</label>
                            <input type="date" name="deadline" value="{{ old('deadline', $project->deadline?->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @foreach (['planning', 'ongoing', 'completed', 'cancelled'] as $s)
                                <option value="{{ $s }}" @selected(old('status', $project->status) == $s)>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('projects.index') }}" class="px-4 py-2 rounded-md border">Batal</a>
                        <button type="submit" class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

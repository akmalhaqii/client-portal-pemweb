<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Tugas - {{ $project->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow p-6">
                <form action="{{ route('projects.tasks.update', [$project, $task]) }}" method="POST" class="space-y-4">
                    @csrf @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Judul</label>
                        <input type="text" name="title" value="{{ old('title', $task->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description', $task->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @foreach (['todo' => 'To Do', 'in_progress' => 'In Progress', 'done' => 'Done'] as $value => $label)
                                <option value="{{ $value }}" @selected(old('status', $task->status) == $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Deadline</label>
                        <input type="date" name="deadline" value="{{ old('deadline', $task->deadline?->format('Y-m-d')) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('projects.tasks.index', $project) }}" class="px-4 py-2 rounded-md border">Batal</a>
                        <button type="submit" class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

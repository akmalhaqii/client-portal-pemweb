<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Klien</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold">{{ $client->name }}</h3>
                <p class="text-gray-500">{{ $client->company ?? '-' }}</p>
                <p class="text-gray-500">{{ $client->phone ?? '-' }}</p>
                <p class="text-gray-500">{{ $client->address ?? '-' }}</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="font-semibold mb-4">Proyek Terkait</h3>
                <table class="w-full text-sm text-left">
                    <thead class="text-gray-500 border-b">
                        <tr>
                            <th class="py-2">Nama Proyek</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Budget</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($client->projects as $project)
                            <tr class="border-b last:border-0">
                                <td class="py-2"><a href="{{ route('projects.show', $project) }}" class="text-indigo-600 hover:underline">{{ $project->name }}</a></td>
                                <td class="py-2">{{ $project->status }}</td>
                                <td class="py-2">Rp {{ number_format($project->budget, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="py-4 text-center text-gray-400">Belum ada proyek.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <a href="{{ route('clients.index') }}" class="text-indigo-600 hover:underline">&larr; Kembali</a>
        </div>
    </div>
</x-app-layout>

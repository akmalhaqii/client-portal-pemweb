<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Laporan Progress - {{ $project->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if (session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-lg shadow p-5">
                <div class="flex justify-between items-center mb-4">
                    <a href="{{ route('projects.show', $project) }}" class="text-indigo-600 hover:underline">&larr; Kembali ke Proyek</a>
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('projects.progress.create', $project) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 text-sm">+ Tambah Laporan</a>
                    @endif
                </div>

                <table class="w-full text-sm text-left">
                    <thead class="text-gray-500 border-b">
                        <tr>
                            <th class="py-2">Persentase</th>
                            <th class="py-2">Deskripsi</th>
                            <th class="py-2">Tanggal</th>
                            <th class="py-2 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reports as $report)
                            <tr class="border-b last:border-0">
                                <td class="py-2 font-semibold">{{ $report->percentage }}%</td>
                                <td class="py-2">{{ $report->description ?? '-' }}</td>
                                <td class="py-2">{{ $report->created_at->format('d M Y') }}</td>
                                <td class="py-2 text-right space-x-2">
                                    @if (auth()->user()->isAdmin())
                                        <a href="{{ route('projects.progress.edit', [$project, $report]) }}" class="text-amber-600 hover:underline">Edit</a>
                                        <form action="{{ route('projects.progress.destroy', [$project, $report]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus laporan ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="py-4 text-center text-gray-400">Belum ada laporan progress.</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">{{ $reports->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>

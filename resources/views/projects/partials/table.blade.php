<table class="w-full text-sm text-left">
    <thead class="text-gray-500 border-b">
        <tr>
            <th class="py-2">Nama Proyek</th>
            <th class="py-2">Klien</th>
            <th class="py-2">Status</th>
            <th class="py-2">Progress</th>
            <th class="py-2">Deadline</th>
            <th class="py-2 text-right">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($projects as $project)
            <tr class="border-b last:border-0">
                <td class="py-2">{{ $project->name }}</td>
                <td class="py-2">{{ $project->client->name ?? '-' }}</td>
                <td class="py-2"><span class="px-2 py-1 rounded text-xs bg-gray-100">{{ $project->status }}</span></td>
                <td class="py-2">{{ $project->latestProgress() }}%</td>
                <td class="py-2">{{ $project->deadline?->format('d M Y') ?? '-' }}</td>
                <td class="py-2 text-right space-x-2">
                    <a href="{{ route('projects.show', $project) }}" class="text-blue-600 hover:underline">Lihat</a>
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('projects.edit', $project) }}" class="text-amber-600 hover:underline">Edit</a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline" onsubmit="return confirm('Hapus proyek ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="py-4 text-center text-gray-400">Tidak ada data proyek.</td></tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $projects->links() }}
</div>

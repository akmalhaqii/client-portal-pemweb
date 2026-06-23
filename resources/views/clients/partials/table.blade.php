<table class="w-full text-sm text-left">
    <thead class="text-gray-500 border-b">
        <tr>
            <th class="py-2">Nama</th>
            <th class="py-2">Perusahaan</th>
            <th class="py-2">Telepon</th>
            <th class="py-2">Jumlah Proyek</th>
            <th class="py-2 text-right">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($clients as $client)
            <tr class="border-b last:border-0">
                <td class="py-2">{{ $client->name }}</td>
                <td class="py-2">{{ $client->company ?? '-' }}</td>
                <td class="py-2">{{ $client->phone ?? '-' }}</td>
                <td class="py-2">{{ $client->projects()->count() }}</td>
                <td class="py-2 text-right space-x-2">
                    <a href="{{ route('clients.show', $client) }}" class="text-blue-600 hover:underline">Lihat</a>
                    <a href="{{ route('clients.edit', $client) }}" class="text-amber-600 hover:underline">Edit</a>
                    <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline" onsubmit="return confirm('Hapus klien ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="py-4 text-center text-gray-400">Tidak ada data klien.</td></tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $clients->links() }}
</div>

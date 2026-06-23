<table class="w-full text-sm text-left">
    <thead class="bg-slate-50 text-slate-500 border-b border-slate-100">
        <tr>
            <th class="py-4 px-6 font-medium">Nama Klien</th>
            <th class="py-4 px-6 font-medium">Perusahaan</th>
            <th class="py-4 px-6 font-medium">Telepon</th>
            <th class="py-4 px-6 font-medium">Alamat</th>
            <th class="py-4 px-6 font-medium text-right">Aksi</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-slate-100">
        @forelse ($clients as $client)
            <tr class="hover:bg-slate-50 transition-colors group">
                <td class="py-4 px-6 font-medium text-slate-800">
                    <div class="flex items-center">
                        <div class="h-8 w-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold mr-3">
                            {{ substr($client->name, 0, 1) }}
                        </div>
                        {{ $client->name }}
                    </div>
                </td>
                <td class="py-4 px-6 text-slate-600">{{ $client->company ?? '-' }}</td>
                <td class="py-4 px-6 text-slate-600">{{ $client->phone ?? '-' }}</td>
                <td class="py-4 px-6 text-slate-600 truncate max-w-xs">{{ $client->address ?? '-' }}</td>
                <td class="py-4 px-6 text-right">
                    <div class="flex justify-end items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <a href="{{ route('clients.show', $client) }}" class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors tooltip" title="Lihat">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </a>
                        <a href="{{ route('clients.edit', $client) }}" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors tooltip" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                        <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline" onsubmit="return confirm('Hapus klien ini beserta semua datanya?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition-colors tooltip" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="py-8 text-center text-slate-500">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <p>Tidak ada data klien.</p>
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="px-6 py-4 border-t border-slate-100">
    {{ $clients->links() }}
</div>

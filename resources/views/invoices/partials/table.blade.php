<table class="w-full text-sm text-left">
    <thead class="text-gray-500 border-b">
        <tr>
            <th class="py-2">Proyek</th>
            <th class="py-2">Klien</th>
            <th class="py-2">Jumlah</th>
            <th class="py-2">Status</th>
            <th class="py-2">Tanggal</th>
            <th class="py-2 text-right">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($invoices as $invoice)
            <tr class="border-b last:border-0">
                <td class="py-2">{{ $invoice->project->name ?? '-' }}</td>
                <td class="py-2">{{ $invoice->project->client->name ?? '-' }}</td>
                <td class="py-2">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</td>
                <td class="py-2"><span class="px-2 py-1 rounded text-xs bg-gray-100">{{ $invoice->status }}</span></td>
                <td class="py-2">{{ $invoice->invoice_date->format('d M Y') }}</td>
                <td class="py-2 text-right space-x-2">
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('invoices.edit', $invoice) }}" class="text-amber-600 hover:underline">Edit</a>
                        <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="inline" onsubmit="return confirm('Hapus invoice ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="py-4 text-center text-gray-400">Tidak ada data invoice.</td></tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $invoices->links() }}
</div>

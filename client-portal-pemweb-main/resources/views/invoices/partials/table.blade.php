<table class="w-full text-sm text-left">
    <thead class="bg-slate-50 text-slate-500 border-b border-slate-100">
        <tr>
            <th class="py-4 px-6 font-medium">Proyek</th>
            <th class="py-4 px-6 font-medium">Klien</th>
            <th class="py-4 px-6 font-medium">Jumlah</th>
            <th class="py-4 px-6 font-medium">Status</th>
            <th class="py-4 px-6 font-medium">Tanggal</th>
            <th class="py-4 px-6 font-medium text-right">Aksi</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-slate-100">
        @forelse ($invoices as $invoice)
            <tr class="hover:bg-slate-50 transition-colors group">
                <td class="py-4 px-6 font-medium text-slate-800">
                    <a href="{{ $invoice->project ? route('projects.show', $invoice->project) : '#' }}" class="hover:text-indigo-600 transition-colors">
                        {{ $invoice->project->name ?? '-' }}
                    </a>
                </td>
                <td class="py-4 px-6 text-slate-600">{{ $invoice->project->client->name ?? '-' }}</td>
                <td class="py-4 px-6 font-bold text-slate-700">Rp {{ number_format($invoice->amount, 0, ',', '.') }}</td>
                <td class="py-4 px-6">
                    @php
                        $iColor = match($invoice->status) {
                            'paid' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                            'unpaid' => 'bg-amber-100 text-amber-700 border-amber-200',
                            'overdue' => 'bg-rose-100 text-rose-700 border-rose-200',
                            default => 'bg-slate-100 text-slate-700 border-slate-200',
                        };
                    @endphp
                    <span class="px-2.5 py-1 rounded-full text-[10px] uppercase tracking-wider font-bold border {{ $iColor }}">
                        {{ $invoice->status }}
                    </span>
                </td>
                <td class="py-4 px-6 text-slate-600">{{ $invoice->invoice_date->format('d M Y') }}</td>
                <td class="py-4 px-6 text-right">
                    <div class="flex justify-end items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('invoices.edit', $invoice) }}" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors tooltip" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>
                            <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="inline" onsubmit="return confirm('Hapus invoice ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition-colors tooltip" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        @else
                            <span class="text-slate-400">-</span>
                        @endif
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="py-8 text-center text-slate-500">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <p>Tidak ada data invoice.</p>
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="px-6 py-4 border-t border-slate-100">
    {{ $invoices->links() }}
</div>

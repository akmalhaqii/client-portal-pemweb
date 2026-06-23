<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 6px 8px; text-align: left; }
        th { background-color: #f3f3f3; }
    </style>
</head>
<body>
    <h2>Laporan Invoice</h2>
    <p>Tanggal cetak: {{ now()->format('d M Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Proyek</th>
                <th>Klien</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Tanggal Invoice</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $i => $invoice)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $invoice->project->name ?? '-' }}</td>
                    <td>{{ $invoice->project->client->name ?? '-' }}</td>
                    <td>Rp {{ number_format($invoice->amount, 0, ',', '.') }}</td>
                    <td>{{ $invoice->status }}</td>
                    <td>{{ $invoice->invoice_date->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

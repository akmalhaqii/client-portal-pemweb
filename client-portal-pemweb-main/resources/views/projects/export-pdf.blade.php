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
    <h2>Laporan Proyek</h2>
    <p>Tanggal cetak: {{ now()->format('d M Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Proyek</th>
                <th>Klien</th>
                <th>Budget</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Progress</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $i => $project)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->client->name ?? '-' }}</td>
                    <td>Rp {{ number_format($project->budget, 0, ',', '.') }}</td>
                    <td>{{ $project->deadline?->format('d M Y') ?? '-' }}</td>
                    <td>{{ $project->status }}</td>
                    <td>{{ $project->latestProgress() }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

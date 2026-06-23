<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $project->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if (session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-500">Klien: <strong>{{ $project->client->name ?? '-' }}</strong></p>
                <p class="text-gray-700 mt-2">{{ $project->description ?? '-' }}</p>
                <div class="grid grid-cols-3 gap-4 mt-4 text-sm">
                    <div>Status: <span class="px-2 py-1 rounded bg-gray-100">{{ $project->status }}</span></div>
                    <div>Budget: Rp {{ number_format($project->budget, 0, ',', '.') }}</div>
                    <div>Deadline: {{ $project->deadline?->format('d M Y') ?? '-' }}</div>
                </div>
                <div class="mt-4">
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-emerald-500 h-3 rounded-full" style="width: {{ $project->latestProgress() }}%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Progress: {{ $project->latestProgress() }}%</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-semibold">Tugas (Tasks)</h3>
                    <a href="{{ route('projects.tasks.index', $project) }}" class="text-indigo-600 text-sm hover:underline">Kelola Tugas &rarr;</a>
                </div>
                <ul class="text-sm divide-y">
                    @forelse ($project->tasks->take(5) as $task)
                        <li class="py-2 flex justify-between">
                            <span>{{ $task->title }}</span>
                            <span class="px-2 py-1 rounded text-xs bg-gray-100">{{ $task->status }}</span>
                        </li>
                    @empty
                        <li class="py-2 text-gray-400">Belum ada tugas.</li>
                    @endforelse
                </ul>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-semibold">Laporan Progress</h3>
                    <a href="{{ route('projects.progress.index', $project) }}" class="text-indigo-600 text-sm hover:underline">Kelola Progress &rarr;</a>
                </div>
                <ul class="text-sm divide-y">
                    @forelse ($project->progressReports->take(5) as $report)
                        <li class="py-2 flex justify-between">
                            <span>{{ $report->description ?? '-' }}</span>
                            <span class="font-semibold">{{ $report->percentage }}%</span>
                        </li>
                    @empty
                        <li class="py-2 text-gray-400">Belum ada laporan progress.</li>
                    @endforelse
                </ul>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-semibold">Invoice</h3>
                    <a href="{{ route('invoices.index') }}" class="text-indigo-600 text-sm hover:underline">Lihat Semua Invoice &rarr;</a>
                </div>
                <ul class="text-sm divide-y">
                    @forelse ($project->invoices->take(5) as $invoice)
                        <li class="py-2 flex justify-between">
                            <span>Rp {{ number_format($invoice->amount, 0, ',', '.') }} - {{ $invoice->invoice_date->format('d M Y') }}</span>
                            <span class="px-2 py-1 rounded text-xs bg-gray-100">{{ $invoice->status }}</span>
                        </li>
                    @empty
                        <li class="py-2 text-gray-400">Belum ada invoice.</li>
                    @endforelse
                </ul>
            </div>

            <a href="{{ route('projects.index') }}" class="text-indigo-600 hover:underline">&larr; Kembali</a>
        </div>
    </div>
</x-app-layout>

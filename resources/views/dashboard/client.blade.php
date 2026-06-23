<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard Saya</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white rounded-lg shadow p-5">
                    <p class="text-sm text-gray-500">Proyek Saya</p>
                    <p class="text-3xl font-bold text-indigo-600">{{ $totalProjects }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-5">
                    <p class="text-sm text-gray-500">Rata-rata Progress</p>
                    <p class="text-3xl font-bold text-emerald-600">{{ $avgProgress }}%</p>
                </div>
                <div class="bg-white rounded-lg shadow p-5">
                    <p class="text-sm text-gray-500">Tugas Selesai</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $totalTasksDone }} / {{ $totalTasks }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-5">
                    <p class="text-sm text-gray-500">Invoice</p>
                    <p class="text-3xl font-bold text-amber-600">{{ $totalInvoices }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white rounded-lg shadow p-5">
                    <p class="text-sm text-gray-500">Sudah Dibayar</p>
                    <p class="text-2xl font-bold text-green-600">Rp {{ number_format($totalPaid, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-5">
                    <p class="text-sm text-gray-500">Belum Dibayar</p>
                    <p class="text-2xl font-bold text-red-600">Rp {{ number_format($totalUnpaid, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-5">
                <h3 class="font-semibold text-gray-800 mb-4">Proyek Saya</h3>
                <table class="w-full text-sm text-left">
                    <thead class="text-gray-500 border-b">
                        <tr>
                            <th class="py-2">Nama Proyek</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Deadline</th>
                            <th class="py-2">Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($myProjects as $project)
                            <tr class="border-b last:border-0">
                                <td class="py-2">
                                    <a href="{{ route('projects.show', $project) }}" class="text-indigo-600 hover:underline">{{ $project->name }}</a>
                                </td>
                                <td class="py-2"><span class="px-2 py-1 rounded text-xs bg-gray-100">{{ $project->status }}</span></td>
                                <td class="py-2">{{ $project->deadline?->format('d M Y') ?? '-' }}</td>
                                <td class="py-2">{{ $project->latestProgress() }}%</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="py-4 text-center text-gray-400">Belum ada proyek.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>

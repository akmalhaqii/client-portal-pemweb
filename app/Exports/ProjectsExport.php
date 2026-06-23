<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProjectsExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(protected Collection $projects)
    {
    }

    public function collection(): Collection
    {
        return $this->projects;
    }

    public function headings(): array
    {
        return ['ID', 'Nama Proyek', 'Klien', 'Budget', 'Deadline', 'Status', 'Progress (%)'];
    }

    public function map($project): array
    {
        return [
            $project->id,
            $project->name,
            $project->client->name ?? '-',
            $project->budget,
            $project->deadline?->format('Y-m-d') ?? '-',
            $project->status,
            $project->latestProgress(),
        ];
    }
}

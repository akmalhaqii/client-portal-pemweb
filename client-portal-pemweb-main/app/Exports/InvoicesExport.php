<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InvoicesExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct(protected Collection $invoices)
    {
    }

    public function collection(): Collection
    {
        return $this->invoices;
    }

    public function headings(): array
    {
        return ['ID', 'Proyek', 'Klien', 'Jumlah', 'Status', 'Tanggal Invoice'];
    }

    public function map($invoice): array
    {
        return [
            $invoice->id,
            $invoice->project->name ?? '-',
            $invoice->project->client->name ?? '-',
            $invoice->amount,
            $invoice->status,
            $invoice->invoice_date->format('Y-m-d'),
        ];
    }
}

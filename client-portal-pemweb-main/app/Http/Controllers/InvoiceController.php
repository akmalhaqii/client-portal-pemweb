<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Project;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
// use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InvoicesExport;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $search = $request->get('search');
        $status = $request->get('status');

        $query = Invoice::with('project.client')
            ->when($search, fn ($q, $s) => $q->whereHas('project', fn ($p) => $p->where('name', 'like', "%{$s}%")))
            ->when($status, fn ($q, $s) => $q->where('status', $s));

        if ($user->isClient()) {
            $projectIds = $user->client?->projects()->pluck('id') ?? collect();
            $query->whereIn('project_id', $projectIds);
        }

        $invoices = $query->latest()->paginate(10)->withQueryString();

        if ($request->ajax()) {
            return view('invoices.partials.table', compact('invoices'))->render();
        }

        return view('invoices.index', compact('invoices', 'search', 'status'));
    }

    public function create()
    {
        $projects = Project::orderBy('name')->get();

        return view('invoices.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id'   => 'required|exists:projects,id',
            'amount'       => 'required|numeric|min:0',
            'status'       => 'required|in:unpaid,paid,overdue',
            'invoice_date' => 'required|date',
        ]);

        Invoice::create($validated);

        return redirect()->route('invoices.index')->with('success', 'Invoice berhasil ditambahkan.');
    }

    public function edit(Invoice $invoice)
    {
        $projects = Project::orderBy('name')->get();

        return view('invoices.edit', compact('invoice', 'projects'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'project_id'   => 'required|exists:projects,id',
            'amount'       => 'required|numeric|min:0',
            'status'       => 'required|in:unpaid,paid,overdue',
            'invoice_date' => 'required|date',
        ]);

        $invoice->update($validated);

        return redirect()->route('invoices.index')->with('success', 'Invoice berhasil diperbarui.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('invoices.index')->with('success', 'Invoice berhasil dihapus.');
    }

    /**
     * Export laporan invoice ke PDF.
     * Route: GET /invoices/export/pdf
     */
    public function exportPdf(Request $request)
    {
        $invoices = $this->filteredInvoices($request)->get();

        $pdf = Pdf::loadView('invoices.export-pdf', compact('invoices'));

        return $pdf->download('laporan-invoice-' . now()->format('Ymd_His') . '.pdf');
    }

    /**
     * Export laporan invoice ke Excel.
     * Route: GET /invoices/export/excel
     */
    // public function exportExcel(Request $request)
    // {
    //     $invoices = $this->filteredInvoices($request)->get();

    //     return Excel::download(new InvoicesExport($invoices), 'laporan-invoice-' . now()->format('Ymd_His') . '.xlsx');
    // }

    private function filteredInvoices(Request $request)
    {
        $user = $request->user();
        $status = $request->get('status');

        $query = Invoice::with('project.client')
            ->when($status, fn ($q, $s) => $q->where('status', $s));

        if ($user->isClient()) {
            $projectIds = $user->client?->projects()->pluck('id') ?? collect();
            $query->whereIn('project_id', $projectIds);
        }

        return $query->latest();
    }
}
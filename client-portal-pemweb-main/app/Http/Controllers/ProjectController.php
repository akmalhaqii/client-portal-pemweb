<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProjectsExport;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $search = $request->get('search');
        $status = $request->get('status');

        $query = Project::with('client')
            ->when($search, fn ($q, $s) => $q->where('name', 'like', "%{$s}%"))
            ->when($status, fn ($q, $s) => $q->where('status', $s));

        if ($user->isClient()) {
            $clientId = $user->client?->id;
            $query->where('client_id', $clientId);
        }

        $projects = $query->latest()->paginate(10)->withQueryString();

        if ($request->ajax()) {
            return view('projects.partials.table', compact('projects'))->render();
        }

        $clients = Client::orderBy('name')->get(); // untuk dropdown filter (admin)

        return view('projects.index', compact('projects', 'search', 'status', 'clients'));
    }

    public function create()
    {
        $clients = Client::orderBy('name')->get();

        return view('projects.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id'   => 'required|exists:clients,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'budget'      => 'required|numeric|min:0',
            'deadline'    => 'nullable|date',
            'status'      => 'required|in:planning,ongoing,completed,cancelled',
        ]);

        Project::create($validated);

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil ditambahkan.');
    }

    public function show(Request $request, Project $project)
    {
        $this->authorizeClientAccess($request, $project);

        $project->load(['client', 'tasks', 'progressReports' => fn ($q) => $q->latest(), 'invoices' => fn ($q) => $q->latest()]);

        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $clients = Client::orderBy('name')->get();

        return view('projects.edit', compact('project', 'clients'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'client_id'   => 'required|exists:clients,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'budget'      => 'required|numeric|min:0',
            'deadline'    => 'nullable|date',
            'status'      => 'required|in:planning,ongoing,completed,cancelled',
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Proyek berhasil dihapus.');
    }

    /**
     * Export laporan proyek ke PDF.
     * Route: GET /projects/export/pdf
     */
    public function exportPdf(Request $request)
    {
        $projects = $this->filteredProjects($request)->get();

        $pdf = Pdf::loadView('projects.export-pdf', compact('projects'));

        return $pdf->download('laporan-proyek-' . now()->format('Ymd_His') . '.pdf');
    }

    /**
     * Export laporan proyek ke Excel.
     * Route: GET /projects/export/excel
     */
    public function exportExcel(Request $request)
    {
        $projects = $this->filteredProjects($request)->get();

        return Excel::download(new ProjectsExport($projects), 'laporan-proyek-' . now()->format('Ymd_His') . '.xlsx');
    }

    private function filteredProjects(Request $request)
    {
        $user = $request->user();
        $status = $request->get('status');

        $query = Project::with('client')
            ->when($status, fn ($q, $s) => $q->where('status', $s));

        if ($user->isClient()) {
            $query->where('client_id', $user->client?->id);
        }

        return $query->latest();
    }

    /**
     * Pastikan client tidak bisa mengakses proyek milik orang lain.
     */
    private function authorizeClientAccess(Request $request, Project $project): void
    {
        $user = $request->user();

        if ($user->isClient() && $project->client_id !== $user->client?->id) {
            abort(403, 'Anda tidak memiliki akses ke proyek ini.');
        }
    }
}

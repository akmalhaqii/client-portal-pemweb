<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProgressReport;
use Illuminate\Http\Request;

class ProgressReportController extends Controller
{
    public function index(Request $request, Project $project)
    {
        $this->authorizeClientAccess($request, $project);

        $reports = $project->progressReports()->latest()->paginate(10);

        return view('progress_reports.index', compact('project', 'reports'));
    }

    public function create(Project $project)
    {
        return view('progress_reports.create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'percentage'  => 'required|integer|min:0|max:100',
            'description' => 'nullable|string',
        ]);

        $project->progressReports()->create($validated);

        return redirect()->route('projects.progress.index', $project)->with('success', 'Laporan progress ditambahkan.');
    }

    public function edit(Project $project, ProgressReport $progress)
    {
        return view('progress_reports.edit', compact('project', 'progress'));
    }

    public function update(Request $request, Project $project, ProgressReport $progress)
    {
        $validated = $request->validate([
            'percentage'  => 'required|integer|min:0|max:100',
            'description' => 'nullable|string',
        ]);

        $progress->update($validated);

        return redirect()->route('projects.progress.index', $project)->with('success', 'Laporan progress diperbarui.');
    }

    public function destroy(Project $project, ProgressReport $progress)
    {
        $progress->delete();

        return redirect()->route('projects.progress.index', $project)->with('success', 'Laporan progress dihapus.');
    }

    private function authorizeClientAccess(Request $request, Project $project): void
    {
        $user = $request->user();

        if ($user->isClient() && $project->client_id !== $user->client?->id) {
            abort(403, 'Anda tidak memiliki akses ke proyek ini.');
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            $totalProjects   = Project::count();
            $totalTasksDone  = Task::where('status', 'done')->count();
            $totalTasks      = Task::count();
            $totalInvoices   = Invoice::count();
            $totalUnpaid     = Invoice::where('status', 'unpaid')->sum('amount');
            $totalPaid       = Invoice::where('status', 'paid')->sum('amount');
            $avgProgress     = round((float) Project::with('progressReports')->get()
                ->avg(fn ($p) => $p->latestProgress()), 1);

            $recentProjects = Project::with('client')->latest()->take(5)->get();

            return view('dashboard.admin', compact(
                'totalProjects', 'totalTasksDone', 'totalTasks',
                'totalInvoices', 'totalUnpaid', 'totalPaid', 'avgProgress', 'recentProjects'
            ));
        }

        // Client: hanya data miliknya sendiri
        $client = $user->client;
        $projectIds = $client?->projects()->pluck('id') ?? collect();

        $totalProjects  = $projectIds->count();
        $totalTasksDone = Task::whereIn('project_id', $projectIds)->where('status', 'done')->count();
        $totalTasks     = Task::whereIn('project_id', $projectIds)->count();
        $totalInvoices  = Invoice::whereIn('project_id', $projectIds)->count();
        $totalUnpaid    = Invoice::whereIn('project_id', $projectIds)->where('status', 'unpaid')->sum('amount');
        $totalPaid      = Invoice::whereIn('project_id', $projectIds)->where('status', 'paid')->sum('amount');

        $myProjects = $client
            ? $client->projects()->with('progressReports')->latest()->get()
            : collect();

        $avgProgress = round((float) $myProjects->avg(fn ($p) => $p->latestProgress()), 1);

        return view('dashboard.client', compact(
            'totalProjects', 'totalTasksDone', 'totalTasks',
            'totalInvoices', 'totalUnpaid', 'totalPaid', 'avgProgress', 'myProjects'
        ));
    }
}

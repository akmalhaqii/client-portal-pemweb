<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request, Project $project)
    {
        $this->authorizeClientAccess($request, $project);

        $tasks = $project->tasks()->latest()->paginate(10);

        return view('tasks.index', compact('project', 'tasks'));
    }

    public function create(Project $project)
    {
        return view('tasks.create', compact('project'));
    }

    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:todo,in_progress,done',
            'deadline'    => 'nullable|date',
        ]);

        $project->tasks()->create($validated);

        return redirect()->route('projects.tasks.index', $project)->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function edit(Project $project, Task $task)
    {
        return view('tasks.edit', compact('project', 'task'));
    }

    public function update(Request $request, Project $project, Task $task)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:todo,in_progress,done',
            'deadline'    => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect()->route('projects.tasks.index', $project)->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();

        return redirect()->route('projects.tasks.index', $project)->with('success', 'Tugas berhasil dihapus.');
    }

    private function authorizeClientAccess(Request $request, Project $project): void
    {
        $user = $request->user();

        if ($user->isClient() && $project->client_id !== $user->client?->id) {
            abort(403, 'Anda tidak memiliki akses ke proyek ini.');
        }
    }
}
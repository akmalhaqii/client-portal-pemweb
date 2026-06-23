<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProgressReportController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
        Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

        Route::resource('invoices', InvoiceController::class)->except(['index', 'show']);

        Route::resource('clients', ClientController::class)->except(['index', 'show']);

        Route::get('/projects/{project}/tasks/create', [TaskController::class, 'create'])->name('projects.tasks.create');
        Route::post('/projects/{project}/tasks', [TaskController::class, 'store'])->name('projects.tasks.store');
        Route::get('/projects/{project}/tasks/{task}/edit', [TaskController::class, 'edit'])->name('projects.tasks.edit');
        Route::put('/projects/{project}/tasks/{task}', [TaskController::class, 'update'])->name('projects.tasks.update');
        Route::delete('/projects/{project}/tasks/{task}', [TaskController::class, 'destroy'])->name('projects.tasks.destroy');

        Route::get('/projects/{project}/progress/create', [ProgressReportController::class, 'create'])->name('projects.progress.create');
        Route::post('/projects/{project}/progress', [ProgressReportController::class, 'store'])->name('projects.progress.store');
        Route::get('/projects/{project}/progress/{progress}/edit', [ProgressReportController::class, 'edit'])->name('projects.progress.edit');
        Route::put('/projects/{project}/progress/{progress}', [ProgressReportController::class, 'update'])->name('projects.progress.update');
        Route::delete('/projects/{project}/progress/{progress}', [ProgressReportController::class, 'destroy'])->name('projects.progress.destroy');

        Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
        Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');
    });

    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/export/pdf', [ProjectController::class, 'exportPdf'])->name('projects.export.pdf');

    Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/export/pdf', [InvoiceController::class, 'exportPdf'])->name('invoices.export.pdf');

    Route::get('/projects/{project}/tasks', [TaskController::class, 'index'])->name('projects.tasks.index');
    Route::get('/projects/{project}/progress', [ProgressReportController::class, 'index'])->name('projects.progress.index');

    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
});

require __DIR__.'/auth.php';
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'name', 'description', 'budget', 'deadline', 'status',
    ];

    protected $casts = [
        'deadline' => 'date',
        'budget' => 'decimal:2',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function progressReports(): HasMany
    {
        return $this->hasMany(ProgressReport::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    // progress terakhir (persentase) untuk ditampilkan cepat di list/dashboard
    public function latestProgress(): int
    {
        // Jika status proyek sudah selesai, progress pasti 100%
        if ($this->status === 'completed') {
            return 100;
        }

        // Jika status masih planning, progress pasti 0%
        if ($this->status === 'planning') {
            return 0;
        }

        // Ambil laporan progress manual terbaru jika ada
        $latestReport = $this->progressReports()->latest()->value('percentage');
        if ($latestReport !== null) {
            return (int) $latestReport;
        }

        // Jika tidak ada laporan manual, hitung otomatis dari jumlah task yang selesai
        $totalTasks = $this->tasks()->count();
        if ($totalTasks === 0) {
            return 0;
        }

        $completedTasks = $this->tasks()->where('status', 'done')->count();
        return (int) round(($completedTasks / $totalTasks) * 100);
    }
}

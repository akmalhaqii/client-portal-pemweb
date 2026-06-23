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
        return (int) ($this->progressReports()->latest()->value('percentage') ?? 0);
    }
}

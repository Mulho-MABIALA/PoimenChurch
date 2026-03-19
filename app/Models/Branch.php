<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'address',
        'city',
        'leader_id',
        'assistant_leader_id',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    // Relations
    public function leader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function assistantLeader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assistant_leader_id');
    }

    public function zones(): HasMany
    {
        return $this->hasMany(Zone::class);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'branch_member')->withTimestamps();
    }

    public function bacentas(): HasManyThrough
    {
        return $this->hasManyThrough(Bacenta::class, Zone::class);
    }

    public function financialTransactions(): HasMany
    {
        return $this->hasMany(FinancialTransaction::class);
    }

    // Statistics
    public function getTotalMembersCountAttribute(): int
    {
        return $this->members()->count() +
               $this->zones->sum(fn($zone) => $zone->members()->count());
    }

    public function getTotalBacentasCountAttribute(): int
    {
        return $this->bacentas()->count();
    }

    public function getWeeklyAttendance(string $reportType, $startDate, $endDate): int
    {
        return BacentaReport::whereHas('bacenta.zone', fn($q) => $q->where('branch_id', $this->id))
            ->where('report_type', $reportType)
            ->whereBetween('report_date', [$startDate, $endDate])
            ->sum('attendance_count');
    }

    public function getWeeklyOfferings($startDate, $endDate): float
    {
        return BacentaReport::whereHas('bacenta.zone', fn($q) => $q->where('branch_id', $this->id))
            ->whereBetween('report_date', [$startDate, $endDate])
            ->sum('offering_amount');
    }
}

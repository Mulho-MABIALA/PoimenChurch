<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'branch_id',
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
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function leader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function assistantLeader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assistant_leader_id');
    }

    public function bacentas(): HasMany
    {
        return $this->hasMany(Bacenta::class);
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'zone_member')->withTimestamps();
    }

    public function financialTransactions(): HasMany
    {
        return $this->hasMany(FinancialTransaction::class);
    }

    // Statistics
    public function getTotalMembersCountAttribute(): int
    {
        $directMembers = $this->members()->count();
        $bacentaMembers = $this->bacentas->sum(fn($bacenta) => $bacenta->members()->count());
        return $directMembers + $bacentaMembers;
    }

    public function getActiveBacentasCountAttribute(): int
    {
        return $this->bacentas()->where('is_active', true)->count();
    }

    public function getWeeklyAttendance(string $reportType, $startDate, $endDate): int
    {
        return BacentaReport::whereHas('bacenta', fn($q) => $q->where('zone_id', $this->id))
            ->where('report_type', $reportType)
            ->whereBetween('report_date', [$startDate, $endDate])
            ->sum('attendance_count');
    }

    public function getWeeklyOfferings($startDate, $endDate): float
    {
        return BacentaReport::whereHas('bacenta', fn($q) => $q->where('zone_id', $this->id))
            ->whereBetween('report_date', [$startDate, $endDate])
            ->sum('offering_amount');
    }

    public function getGrowthTrend(int $weeks = 4): array
    {
        $trends = [];
        for ($i = $weeks - 1; $i >= 0; $i--) {
            $startDate = now()->subWeeks($i)->startOfWeek();
            $endDate = now()->subWeeks($i)->endOfWeek();
            $trends[] = [
                'week' => $startDate->format('d/m'),
                'attendance' => $this->getWeeklyAttendance('sunday_service', $startDate, $endDate),
                'offerings' => $this->getWeeklyOfferings($startDate, $endDate),
            ];
        }
        return $trends;
    }
}

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
        // Une seule sous-requête au lieu de N requêtes COUNT (N+1 fix)
        $bacentaIds = $this->bacentas()->pluck('id');
        $directMembers  = $this->members()->count();
        $bacentaMembers = \DB::table('bacenta_member')
            ->whereIn('bacenta_id', $bacentaIds)
            ->count();
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
        $rangeStart = now()->subWeeks($weeks - 1)->startOfWeek();
        $rangeEnd   = now()->endOfWeek();

        // Une seule requête GROUP BY au lieu de ($weeks × 2) requêtes en boucle
        $rows = BacentaReport::selectRaw(
                'YEARWEEK(report_date, 1) as yw,
                 SUM(CASE WHEN report_type = ? THEN attendance_count ELSE 0 END) as attendance,
                 SUM(offering_amount) as offerings',
                ['sunday_service']
            )
            ->whereHas('bacenta', fn($q) => $q->where('zone_id', $this->id))
            ->whereBetween('report_date', [$rangeStart, $rangeEnd])
            ->groupByRaw('YEARWEEK(report_date, 1)')
            ->get()
            ->keyBy('yw');

        $trends = [];
        for ($i = $weeks - 1; $i >= 0; $i--) {
            $weekStart = now()->subWeeks($i)->startOfWeek();
            $yw = $weekStart->format('oW');
            $trends[] = [
                'week'      => $weekStart->format('d/m'),
                'attendance' => isset($rows[$yw]) ? (int)   $rows[$yw]->attendance : 0,
                'offerings'  => isset($rows[$yw]) ? (float) $rows[$yw]->offerings  : 0,
            ];
        }

        return $trends;
    }
}

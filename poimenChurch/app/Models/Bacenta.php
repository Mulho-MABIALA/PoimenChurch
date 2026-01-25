<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bacenta extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'address',
        'zone_id',
        'shepherd_id',
        'assistant_shepherd_id',
        'meeting_day',
        'meeting_time',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'meeting_time' => 'datetime:H:i',
            'is_active' => 'boolean',
        ];
    }

    // Relations
    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function shepherd(): BelongsTo
    {
        return $this->belongsTo(User::class, 'shepherd_id');
    }

    public function assistantShepherd(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assistant_shepherd_id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'bacenta_member')->withTimestamps();
    }

    public function reports(): HasMany
    {
        return $this->hasMany(BacentaReport::class);
    }

    // Helper methods
    public function getMembersCountAttribute(): int
    {
        return $this->members()->count();
    }

    public function getLatestReport(string $reportType = null): ?BacentaReport
    {
        $query = $this->reports()->latest('report_date');

        if ($reportType) {
            $query->where('report_type', $reportType);
        }

        return $query->first();
    }

    public function getWeeklyReport($startDate, $endDate): array
    {
        $reports = $this->reports()
            ->whereBetween('report_date', [$startDate, $endDate])
            ->get();

        return [
            'bacenta_meeting' => $reports->where('report_type', 'bacenta_meeting')->first(),
            'sunday_service' => $reports->where('report_type', 'sunday_service')->first(),
            'total_attendance' => $reports->sum('attendance_count'),
            'total_offerings' => $reports->sum('offering_amount'),
        ];
    }

    public function hasSubmittedReport(string $reportType, $date): bool
    {
        return $this->reports()
            ->where('report_type', $reportType)
            ->whereDate('report_date', $date)
            ->exists();
    }

    public function getAverageAttendance(int $weeks = 4, string $reportType = 'sunday_service'): float
    {
        $startDate = now()->subWeeks($weeks);

        $reports = $this->reports()
            ->where('report_type', $reportType)
            ->where('report_date', '>=', $startDate)
            ->get();

        return $reports->count() > 0 ? round($reports->avg('attendance_count'), 1) : 0;
    }

    public function getMeetingDayLabelAttribute(): string
    {
        $days = [
            'monday' => 'Lundi',
            'tuesday' => 'Mardi',
            'wednesday' => 'Mercredi',
            'thursday' => 'Jeudi',
            'friday' => 'Vendredi',
            'saturday' => 'Samedi',
            'sunday' => 'Dimanche',
        ];

        return $days[$this->meeting_day] ?? $this->meeting_day;
    }
}

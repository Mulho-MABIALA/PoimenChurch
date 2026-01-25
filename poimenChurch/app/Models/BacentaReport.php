<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BacentaReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'bacenta_id',
        'submitted_by',
        'report_date',
        'report_type',
        'attendance_count',
        'offering_amount',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'report_date' => 'date',
            'attendance_count' => 'integer',
            'offering_amount' => 'decimal:2',
        ];
    }

    // Relations
    public function bacenta(): BelongsTo
    {
        return $this->belongsTo(Bacenta::class);
    }

    public function submittedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function memberAttendances(): HasMany
    {
        return $this->hasMany(MemberAttendance::class, 'bacenta_report_id');
    }

    // Helper methods
    public function getReportTypeLabelAttribute(): string
    {
        return match($this->report_type) {
            'bacenta_meeting' => 'Réunion Bacenta',
            'sunday_service' => 'Culte du Dimanche',
            default => $this->report_type,
        };
    }

    // Scopes
    public function scopeForWeek($query, $date = null)
    {
        $date = $date ?? now();
        return $query->whereBetween('report_date', [
            $date->copy()->startOfWeek(),
            $date->copy()->endOfWeek(),
        ]);
    }

    public function scopeForMonth($query, $month = null, $year = null)
    {
        $month = $month ?? now()->month;
        $year = $year ?? now()->year;

        return $query->whereMonth('report_date', $month)
                     ->whereYear('report_date', $year);
    }

    public function scopeBacentaMeeting($query)
    {
        return $query->where('report_type', 'bacenta_meeting');
    }

    public function scopeSundayService($query)
    {
        return $query->where('report_type', 'sunday_service');
    }
}

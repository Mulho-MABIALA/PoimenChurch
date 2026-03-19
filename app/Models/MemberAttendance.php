<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MemberAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bacenta_report_id',
        'attendance_date',
        'attendance_type',
        'is_present',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'attendance_date' => 'date',
            'is_present' => 'boolean',
        ];
    }

    // Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bacentaReport(): BelongsTo
    {
        return $this->belongsTo(BacentaReport::class, 'bacenta_report_id');
    }

    // Helper methods
    public function getAttendanceTypeLabelAttribute(): string
    {
        return match($this->attendance_type) {
            'bacenta_meeting' => 'Réunion Bacenta',
            'sunday_service' => 'Culte du Dimanche',
            default => $this->attendance_type,
        };
    }

    // Scopes
    public function scopePresent($query)
    {
        return $query->where('is_present', true);
    }

    public function scopeAbsent($query)
    {
        return $query->where('is_present', false);
    }

    public function scopeForPeriod($query, $startDate, $endDate)
    {
        return $query->whereBetween('attendance_date', [$startDate, $endDate]);
    }
}

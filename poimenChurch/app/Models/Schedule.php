<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'day_of_week',
        'start_time',
        'end_time',
        'location',
        'icon',
        'icon_color',
        'is_featured',
        'is_active',
        'order',
        'branch_id',
    ];

    protected function casts(): array
    {
        return [
            'start_time' => 'datetime:H:i',
            'end_time' => 'datetime:H:i',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    const DAYS = [
        'sunday' => 'Dimanche',
        'monday' => 'Lundi',
        'tuesday' => 'Mardi',
        'wednesday' => 'Mercredi',
        'thursday' => 'Jeudi',
        'friday' => 'Vendredi',
        'saturday' => 'Samedi',
        'daily' => 'Tous les jours',
    ];

    const ICONS = [
        'sun' => 'Soleil (Culte)',
        'book' => 'Livre (Étude)',
        'heart' => 'Coeur (Prière)',
        'users' => 'Groupe (Réunion)',
        'music' => 'Musique (Louange)',
        'child' => 'Enfant (École du dimanche)',
        'cross' => 'Croix (Culte spécial)',
    ];

    const COLORS = [
        'primary' => 'Vert (Primary)',
        'gold' => 'Or (Gold)',
        'blue' => 'Bleu',
        'purple' => 'Violet',
        'red' => 'Rouge',
    ];

    // Relationships
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    // Accessors
    public function getDayLabelAttribute(): string
    {
        return self::DAYS[$this->day_of_week] ?? $this->day_of_week;
    }

    public function getFormattedTimeAttribute(): string
    {
        $start = date('H\hi', strtotime($this->start_time));
        if ($this->end_time) {
            $end = date('H\hi', strtotime($this->end_time));
            return "{$start} - {$end}";
        }
        return $start;
    }

    public function getDisplayTimeAttribute(): string
    {
        if ($this->day_of_week === 'sunday' || $this->day_of_week === 'daily') {
            return $this->formatted_time;
        }
        return $this->day_label . ' ' . $this->formatted_time;
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('start_time');
    }
}

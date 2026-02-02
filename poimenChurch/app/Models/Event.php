<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'image',
        'start_date',
        'end_date',
        'location',
        'address',
        'city',
        'type',
        'registration_fee',
        'max_participants',
        'is_featured',
        'is_published',
        'registration_required',
        'created_by',
        'branch_id',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'registration_fee' => 'decimal:2',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'registration_required' => 'boolean',
        ];
    }

    const TYPES = [
        'culte' => 'Culte spécial',
        'conference' => 'Conférence',
        'seminaire' => 'Séminaire',
        'retraite' => 'Retraite',
        'concert' => 'Concert',
        'formation' => 'Formation',
        'autre' => 'Autre',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->title);
            }
            // Ensure unique slug
            $originalSlug = $event->slug;
            $count = 1;
            while (static::where('slug', $event->slug)->exists()) {
                $event->slug = $originalSlug . '-' . $count++;
            }
        });

        static::updating(function ($event) {
            if ($event->isDirty('title') && !$event->isDirty('slug')) {
                $event->slug = Str::slug($event->title);
                $originalSlug = $event->slug;
                $count = 1;
                while (static::where('slug', $event->slug)->where('id', '!=', $event->id)->exists()) {
                    $event->slug = $originalSlug . '-' . $count++;
                }
            }
        });
    }

    // Relationships
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    // Accessors
    public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->type] ?? $this->type;
    }

    public function getFormattedDateAttribute(): string
    {
        if ($this->end_date && $this->start_date->format('Y-m-d') !== $this->end_date->format('Y-m-d')) {
            return $this->start_date->translatedFormat('d M Y') . ' - ' . $this->end_date->translatedFormat('d M Y');
        }
        return $this->start_date->translatedFormat('d M Y');
    }

    public function getFormattedTimeAttribute(): string
    {
        if ($this->end_date) {
            return $this->start_date->format('H:i') . ' - ' . $this->end_date->format('H:i');
        }
        return $this->start_date->format('H:i');
    }

    public function getIsUpcomingAttribute(): bool
    {
        return $this->start_date->isFuture();
    }

    public function getIsPastAttribute(): bool
    {
        $endDate = $this->end_date ?? $this->start_date;
        return $endDate->isPast();
    }

    public function getIsOngoingAttribute(): bool
    {
        $now = now();
        $endDate = $this->end_date ?? $this->start_date->endOfDay();
        return $this->start_date->lte($now) && $endDate->gte($now);
    }

    public function getStatusAttribute(): string
    {
        if ($this->is_ongoing) return 'En cours';
        if ($this->is_upcoming) return 'À venir';
        return 'Passé';
    }

    public function getStatusColorAttribute(): string
    {
        if ($this->is_ongoing) return 'green';
        if ($this->is_upcoming) return 'blue';
        return 'gray';
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now());
    }

    public function scopePast($query)
    {
        return $query->where(function ($q) {
            $q->where('end_date', '<', now())
              ->orWhere(function ($q2) {
                  $q2->whereNull('end_date')->where('start_date', '<', now());
              });
        });
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeOrderByDate($query, $direction = 'asc')
    {
        return $query->orderBy('start_date', $direction);
    }
}

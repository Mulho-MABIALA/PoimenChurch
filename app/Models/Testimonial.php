<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Testimonial extends Model
{
    protected $fillable = [
        'author_name',
        'author_role',
        'author_photo',
        'content',
        'rating',
        'is_featured',
        'is_active',
        'display_order',
        'testimonial_date',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'rating' => 'integer',
        'display_order' => 'integer',
        'testimonial_date' => 'date',
    ];

    // Scopes
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('display_order')->orderByDesc('created_at');
    }

    // Accessors
    public function getPhotoUrlAttribute(): string
    {
        if ($this->author_photo) {
            return asset('storage/' . $this->author_photo);
        }

        // Return a default avatar with initials
        $initials = collect(explode(' ', $this->author_name))
            ->map(fn($word) => strtoupper(substr($word, 0, 1)))
            ->take(2)
            ->join('');

        return "https://ui-avatars.com/api/?name={$initials}&background=166534&color=fff&size=128";
    }

    public function getShortContentAttribute(): string
    {
        return \Str::limit($this->content, 150);
    }
}

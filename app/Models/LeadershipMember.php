<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LeadershipMember extends Model
{
    protected $fillable = [
        'name',
        'title',
        'bio',
        'photo',
        'facebook_url',
        'twitter_url',
        'is_senior_pastor',
        'is_active',
        'display_order',
    ];

    protected $casts = [
        'is_senior_pastor' => 'boolean',
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo) {
            return Storage::url($this->photo);
        }

        return '';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order')->orderBy('name');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'admin_notes',
    ];

    public function isNew(): bool
    {
        return $this->status === 'nouveau';
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            'nouveau'  => 'Nouveau',
            'lu'       => 'Lu',
            'repondu'  => 'Repondu',
            'archive'  => 'Archive',
            default    => $this->status,
        };
    }

    public function statusColor(): string
    {
        return match ($this->status) {
            'nouveau'  => 'blue',
            'lu'       => 'gray',
            'repondu'  => 'green',
            'archive'  => 'yellow',
            default    => 'gray',
        };
    }

    public function scopeNouveau($query)
    {
        return $query->where('status', 'nouveau');
    }

    public function scopeBySubject($query, string $subject)
    {
        return $query->where('subject', $subject);
    }
}

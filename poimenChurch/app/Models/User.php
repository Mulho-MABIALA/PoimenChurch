<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'photo',
        'date_of_birth',
        'gender',
        'address',
        'occupation',
        'workplace',
        'church_class',
        'school_class',
        'member_since',
        'baptism_date',
        'is_active',
        'locale',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'date_of_birth' => 'date',
            'member_since' => 'date',
            'baptism_date' => 'date',
            'is_active' => 'boolean',
            'password' => 'hashed',
        ];
    }

    // Accessors
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    // Relations - Branches
    public function ledBranches(): HasMany
    {
        return $this->hasMany(Branch::class, 'leader_id');
    }

    public function assistedBranches(): HasMany
    {
        return $this->hasMany(Branch::class, 'assistant_leader_id');
    }

    public function branches(): BelongsToMany
    {
        return $this->belongsToMany(Branch::class, 'branch_member')->withTimestamps();
    }

    // Relations - Zones
    public function ledZones(): HasMany
    {
        return $this->hasMany(Zone::class, 'leader_id');
    }

    public function assistedZones(): HasMany
    {
        return $this->hasMany(Zone::class, 'assistant_leader_id');
    }

    public function zones(): BelongsToMany
    {
        return $this->belongsToMany(Zone::class, 'zone_member')->withTimestamps();
    }

    // Relations - Bacentas
    public function shepherdedBacentas(): HasMany
    {
        return $this->hasMany(Bacenta::class, 'shepherd_id');
    }

    public function assistedBacentas(): HasMany
    {
        return $this->hasMany(Bacenta::class, 'assistant_shepherd_id');
    }

    public function bacentas(): BelongsToMany
    {
        return $this->belongsToMany(Bacenta::class, 'bacenta_member')->withTimestamps();
    }

    // Relations - Departments
    public function ledDepartments(): HasMany
    {
        return $this->hasMany(Department::class, 'leader_id');
    }

    public function supervisedDepartments(): HasMany
    {
        return $this->hasMany(Department::class, 'supervisor_id');
    }

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'department_member')->withTimestamps();
    }

    // Relations - Reports & Attendance
    public function submittedReports(): HasMany
    {
        return $this->hasMany(BacentaReport::class, 'submitted_by');
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(MemberAttendance::class);
    }

    // Relations - Finances
    public function donations(): HasMany
    {
        return $this->hasMany(FinancialTransaction::class, 'user_id');
    }

    public function recordedTransactions(): HasMany
    {
        return $this->hasMany(FinancialTransaction::class, 'recorded_by');
    }

    // Helper methods
    public function getAttendanceRate(?string $type = null, int $months = 3): float
    {
        $query = $this->attendances()
            ->where('attendance_date', '>=', now()->subMonths($months));

        if ($type) {
            $query->where('attendance_type', $type);
        }

        $total = $query->count();
        $present = $query->where('is_present', true)->count();

        return $total > 0 ? round(($present / $total) * 100, 2) : 0;
    }

    public function getTotalDonations(?int $year = null, ?string $type = null): float
    {
        $query = $this->donations();

        if ($year) {
            $query->where('fiscal_year', $year);
        }

        if ($type) {
            $query->where('transaction_type', $type);
        }

        return $query->sum('amount');
    }
}

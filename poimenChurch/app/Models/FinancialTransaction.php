<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancialTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'branch_id',
        'zone_id',
        'recorded_by',
        'transaction_type',
        'amount',
        'currency',
        'payment_method',
        'payment_reference',
        'transaction_date',
        'description',
        'fiscal_year',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'transaction_date' => 'date',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->fiscal_year) {
                $model->fiscal_year = $model->transaction_date
                    ? $model->transaction_date->format('Y')
                    : now()->format('Y');
            }
        });
    }

    // Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    // Helper methods
    public function getTransactionTypeLabelAttribute(): string
    {
        return match($this->transaction_type) {
            'tithe' => 'Dîme',
            'offering' => 'Offrande',
            'special_offering' => 'Offrande spéciale',
            default => $this->transaction_type,
        };
    }

    public function getPaymentMethodLabelAttribute(): string
    {
        return match($this->payment_method) {
            'cash' => 'Espèces',
            'mobile_money' => 'Mobile Money',
            'bank_transfer' => 'Virement bancaire',
            'check' => 'Chèque',
            'other' => 'Autre',
            default => $this->payment_method,
        };
    }

    public function getFormattedAmountAttribute(): string
    {
        return number_format($this->amount, 0, ',', ' ') . ' ' . $this->currency;
    }

    // Scopes
    public function scopeTithes($query)
    {
        return $query->where('transaction_type', 'tithe');
    }

    public function scopeOfferings($query)
    {
        return $query->where('transaction_type', 'offering');
    }

    public function scopeSpecialOfferings($query)
    {
        return $query->where('transaction_type', 'special_offering');
    }

    public function scopeForYear($query, $year)
    {
        return $query->where('fiscal_year', $year);
    }

    public function scopeForPeriod($query, $startDate, $endDate)
    {
        return $query->whereBetween('transaction_date', [$startDate, $endDate]);
    }

    // Static methods for aggregations
    public static function getTotalByType(string $type, int $year = null): float
    {
        $query = static::where('transaction_type', $type);

        if ($year) {
            $query->where('fiscal_year', $year);
        }

        return $query->sum('amount');
    }

    public static function getMonthlyTotals(int $year = null): array
    {
        $year = $year ?? now()->year;

        $results = static::selectRaw('MONTH(transaction_date) as month, transaction_type, SUM(amount) as total')
            ->where('fiscal_year', $year)
            ->groupBy('month', 'transaction_type')
            ->get();

        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = [
                'tithe' => 0,
                'offering' => 0,
                'special_offering' => 0,
            ];
        }

        foreach ($results as $result) {
            $months[$result->month][$result->transaction_type] = $result->total;
        }

        return $months;
    }
}

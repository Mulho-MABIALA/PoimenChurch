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
        'approved_by',
        'transaction_type',
        'category',
        'expense_category',
        'funding_source',
        'amount',
        'currency',
        'payment_method',
        'payment_reference',
        'transaction_date',
        'description',
        'vendor',
        'invoice_number',
        'fiscal_year',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'transaction_date' => 'date',
        ];
    }

    // Constants for categories
    const CATEGORY_INCOME = 'income';
    const CATEGORY_EXPENSE = 'expense';

    // Funding sources for expenses
    const FUNDING_TREASURY = 'treasury';   // From church funds (affects balance)
    const FUNDING_EXTERNAL = 'external';   // From external source (doesn't affect balance)

    const FUNDING_SOURCES = [
        'treasury' => 'Caisse de l\'église',
        'external' => 'Source externe',
    ];

    // Expense categories
    const EXPENSE_CATEGORIES = [
        'salaries' => 'Salaires et charges',
        'utilities' => 'Électricité, Eau, Internet',
        'rent' => 'Loyer',
        'maintenance' => 'Entretien et réparations',
        'supplies' => 'Fournitures de bureau',
        'transport' => 'Transport et déplacements',
        'events' => 'Événements et activités',
        'missions' => 'Missions et évangélisation',
        'social' => 'Actions sociales',
        'equipment' => 'Équipements',
        'communication' => 'Communication et marketing',
        'training' => 'Formation',
        'other' => 'Autres dépenses',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->fiscal_year) {
                $model->fiscal_year = $model->transaction_date
                    ? $model->transaction_date->format('Y')
                    : now()->format('Y');
            }
            if (!$model->category) {
                $model->category = self::CATEGORY_INCOME;
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

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Helper methods
    public function isIncome(): bool
    {
        return $this->category === self::CATEGORY_INCOME;
    }

    public function isExpense(): bool
    {
        return $this->category === self::CATEGORY_EXPENSE;
    }

    public function getTransactionTypeLabelAttribute(): string
    {
        if ($this->isExpense()) {
            return self::EXPENSE_CATEGORIES[$this->expense_category] ?? $this->expense_category;
        }

        return match($this->transaction_type) {
            'tithe' => 'Dîme',
            'offering' => 'Offrande',
            'special_offering' => 'Offrande spéciale',
            default => $this->transaction_type,
        };
    }

    public function getExpenseCategoryLabelAttribute(): string
    {
        return self::EXPENSE_CATEGORIES[$this->expense_category] ?? $this->expense_category ?? '';
    }

    public function getCategoryLabelAttribute(): string
    {
        return $this->category === self::CATEGORY_INCOME ? 'Entrée' : 'Sortie';
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

    public function getFundingSourceLabelAttribute(): string
    {
        return self::FUNDING_SOURCES[$this->funding_source] ?? $this->funding_source ?? '';
    }

    public function isFromTreasury(): bool
    {
        return $this->funding_source === self::FUNDING_TREASURY;
    }

    public function isFromExternal(): bool
    {
        return $this->funding_source === self::FUNDING_EXTERNAL;
    }

    public function getFormattedAmountAttribute(): string
    {
        $prefix = $this->isExpense() ? '-' : '+';
        return $prefix . ' ' . number_format($this->amount, 0, ',', ' ') . ' ' . $this->currency;
    }

    // Scopes
    public function scopeIncomes($query)
    {
        return $query->where('category', self::CATEGORY_INCOME);
    }

    public function scopeExpenses($query)
    {
        return $query->where('category', self::CATEGORY_EXPENSE);
    }

    public function scopeTithes($query)
    {
        return $query->incomes()->where('transaction_type', 'tithe');
    }

    public function scopeOfferings($query)
    {
        return $query->incomes()->where('transaction_type', 'offering');
    }

    public function scopeSpecialOfferings($query)
    {
        return $query->incomes()->where('transaction_type', 'special_offering');
    }

    public function scopeForYear($query, $year)
    {
        return $query->where('fiscal_year', $year);
    }

    public function scopeForPeriod($query, $startDate, $endDate)
    {
        return $query->whereBetween('transaction_date', [$startDate, $endDate]);
    }

    public function scopeByExpenseCategory($query, $category)
    {
        return $query->expenses()->where('expense_category', $category);
    }

    public function scopeFromTreasury($query)
    {
        return $query->where('funding_source', self::FUNDING_TREASURY);
    }

    public function scopeFromExternal($query)
    {
        return $query->where('funding_source', self::FUNDING_EXTERNAL);
    }

    public function scopeTreasuryExpenses($query)
    {
        return $query->expenses()->fromTreasury();
    }

    // Static methods for aggregations
    public static function getTotalByType(string $type, int $year = null): float
    {
        $query = static::incomes()->where('transaction_type', $type);

        if ($year) {
            $query->where('fiscal_year', $year);
        }

        return $query->sum('amount');
    }

    public static function getTotalIncomes(int $year = null): float
    {
        $query = static::incomes();

        if ($year) {
            $query->where('fiscal_year', $year);
        }

        return $query->sum('amount');
    }

    public static function getTotalExpenses(int $year = null): float
    {
        $query = static::expenses();

        if ($year) {
            $query->where('fiscal_year', $year);
        }

        return $query->sum('amount');
    }

    /**
     * Get total expenses from treasury (affects balance)
     */
    public static function getTotalTreasuryExpenses(int $year = null): float
    {
        $query = static::treasuryExpenses();

        if ($year) {
            $query->where('fiscal_year', $year);
        }

        return $query->sum('amount');
    }

    /**
     * Get balance (incomes minus treasury expenses only)
     * External expenses don't affect the balance
     */
    public static function getBalance(int $year = null): float
    {
        return static::getTotalIncomes($year) - static::getTotalTreasuryExpenses($year);
    }

    public static function getExpensesByCategory(int $year = null): array
    {
        $query = static::expenses()
            ->selectRaw('expense_category, SUM(amount) as total')
            ->groupBy('expense_category');

        if ($year) {
            $query->where('fiscal_year', $year);
        }

        $results = $query->get();

        $expenses = [];
        foreach (self::EXPENSE_CATEGORIES as $key => $label) {
            $expenses[$key] = [
                'label' => $label,
                'total' => 0,
            ];
        }

        foreach ($results as $result) {
            if (isset($expenses[$result->expense_category])) {
                $expenses[$result->expense_category]['total'] = $result->total;
            }
        }

        return $expenses;
    }

    public static function getMonthlyTotals(int $year = null): array
    {
        $year = $year ?? now()->year;

        $results = static::selectRaw('MONTH(transaction_date) as month, category, transaction_type, expense_category, SUM(amount) as total')
            ->where('fiscal_year', $year)
            ->groupBy('month', 'category', 'transaction_type', 'expense_category')
            ->get();

        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = [
                'tithe' => 0,
                'offering' => 0,
                'special_offering' => 0,
                'total_income' => 0,
                'total_expense' => 0,
                'balance' => 0,
            ];
        }

        foreach ($results as $result) {
            if ($result->category === self::CATEGORY_INCOME) {
                $months[$result->month][$result->transaction_type] = $result->total;
                $months[$result->month]['total_income'] += $result->total;
            } else {
                $months[$result->month]['total_expense'] += $result->total;
            }
            $months[$result->month]['balance'] = $months[$result->month]['total_income'] - $months[$result->month]['total_expense'];
        }

        return $months;
    }
}

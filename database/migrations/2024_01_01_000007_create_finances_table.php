<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete(); // Membre donateur
            $table->foreignId('branch_id')->nullable()->constrained('branches')->nullOnDelete();
            $table->foreignId('zone_id')->nullable()->constrained('zones')->nullOnDelete();
            $table->foreignId('recorded_by')->constrained('users')->cascadeOnDelete(); // Trésorier ou admin
            $table->enum('transaction_type', ['tithe', 'offering', 'special_offering']); // Dîme, offrande, offrande spéciale
            $table->decimal('amount', 12, 2);
            $table->string('currency', 3)->default('XOF'); // Franc CFA
            $table->enum('payment_method', ['cash', 'mobile_money', 'bank_transfer', 'check', 'other'])->default('cash');
            $table->string('payment_reference')->nullable();
            $table->date('transaction_date');
            $table->text('description')->nullable();
            $table->string('fiscal_year', 4);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['transaction_date', 'transaction_type']);
            $table->index(['user_id', 'fiscal_year']);
            $table->index('fiscal_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_transactions');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('financial_transactions', function (Blueprint $table) {
            $table->enum('category', ['income', 'expense'])->default('income')->after('transaction_type');
            $table->string('expense_category')->nullable()->after('category');
            $table->string('vendor')->nullable()->after('description');
            $table->string('invoice_number')->nullable()->after('vendor');
            $table->unsignedBigInteger('approved_by')->nullable()->after('recorded_by');

            $table->foreign('approved_by')->references('id')->on('users')->nullOnDelete();
        });

        // Update existing records to have category = 'income'
        DB::table('financial_transactions')->update(['category' => 'income']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('financial_transactions', function (Blueprint $table) {
            $table->dropForeign(['approved_by']);
            $table->dropColumn(['category', 'expense_category', 'vendor', 'invoice_number', 'approved_by']);
        });
    }
};

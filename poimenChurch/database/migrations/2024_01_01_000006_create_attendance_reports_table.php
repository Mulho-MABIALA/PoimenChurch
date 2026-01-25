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
        // Rapports hebdomadaires de bacenta
        Schema::create('bacenta_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bacenta_id')->constrained('bacentas')->cascadeOnDelete();
            $table->foreignId('submitted_by')->constrained('users')->cascadeOnDelete();
            $table->date('report_date');
            $table->enum('report_type', ['bacenta_meeting', 'sunday_service']); // Réunion bacenta ou culte dimanche
            $table->integer('attendance_count')->default(0);
            $table->decimal('offering_amount', 12, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['bacenta_id', 'report_date', 'report_type']);
            $table->index(['report_date', 'report_type']);
        });

        // Présence individuelle des membres (optionnel pour le suivi détaillé)
        Schema::create('member_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('bacenta_report_id')->nullable()->constrained('bacenta_reports')->cascadeOnDelete();
            $table->date('attendance_date');
            $table->enum('attendance_type', ['bacenta_meeting', 'sunday_service']);
            $table->boolean('is_present')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'attendance_date', 'attendance_type'], 'member_attendance_unique');
            $table->index('attendance_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_attendances');
        Schema::dropIfExists('bacenta_reports');
    }
};

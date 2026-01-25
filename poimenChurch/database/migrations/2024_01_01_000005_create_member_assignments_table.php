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
        // Rattachement d'un membre à une branche
        Schema::create('branch_member', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['user_id', 'branch_id']);
        });

        // Rattachement d'un membre à une zone
        Schema::create('zone_member', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('zone_id')->constrained('zones')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['user_id', 'zone_id']);
        });

        // Rattachement d'un membre à un bacenta
        Schema::create('bacenta_member', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('bacenta_id')->constrained('bacentas')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['user_id', 'bacenta_id']);
        });

        // Rattachement d'un membre à un département
        Schema::create('department_member', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('department_id')->constrained('departments')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['user_id', 'department_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_member');
        Schema::dropIfExists('bacenta_member');
        Schema::dropIfExists('zone_member');
        Schema::dropIfExists('branch_member');
    }
};

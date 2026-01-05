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
        Schema::create('flexible_schedule_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('assigned_by')->constrained('users')->onDelete('no action');
            $table->unsignedTinyInteger('month');
            $table->unsignedSmallInteger('year');
            $table->time('start_time');
            $table->timestamps();
            $table->unique(['user_id', 'month', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flexible_schedule_assignments');
    }
};

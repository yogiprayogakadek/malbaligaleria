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
        Schema::dropIfExists('monthly_visitors');

        Schema::create('daily_visitors', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique();
            $table->unsignedInteger('visit_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_visitors');

        Schema::create('monthly_visitors', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('year');
            $table->unsignedTinyInteger('month');
            $table->unsignedInteger('visit_count');
            $table->timestamps();

            $table->unique(['year', 'month']);
        });
    }
};

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
        Schema::create('job_application_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_application_id')->index();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->unsignedTinyInteger('rating')->nullable();
            $table->text('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_application_reviews');
    }
};

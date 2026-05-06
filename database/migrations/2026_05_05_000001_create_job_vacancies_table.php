<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('title');
            $table->string('department');
            $table->enum('type', ['full-time', 'part-time', 'contract', 'internship'])->default('full-time');
            $table->string('location')->default('Kuta, Bali');
            $table->longText('description');
            $table->longText('requirements');
            $table->longText('responsibilities')->nullable();
            $table->string('salary_range')->nullable();
            $table->date('deadline')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_vacancies');
    }
};

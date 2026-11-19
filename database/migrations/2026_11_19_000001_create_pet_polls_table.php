<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pet_polls', function (Blueprint $table) {
            $table->id();
            $table->string('title', 80);
            $table->string('question', 200);
            $table->string('pet_scope', 300);
            $table->timestamp('closes_at')->nullable();
            $table->boolean('is_open')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pet_polls');
    }
};

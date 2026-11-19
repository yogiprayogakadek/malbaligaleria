<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pet_poll_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pet_poll_id')->constrained('pet_polls')->cascadeOnDelete();
            $table->foreignId('tenant_id')->constrained('tenants')->cascadeOnDelete();
            $table->boolean('allows_pets');
            $table->string('note', 300)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 255)->nullable();
            $table->timestamp('responded_at');
            $table->timestamps();

            $table->unique(['pet_poll_id', 'tenant_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pet_poll_responses');
    }
};

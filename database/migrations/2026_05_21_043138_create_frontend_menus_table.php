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
        Schema::create('frontend_menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->boolean('is_active')->default(true);
            $table->json('roles')->nullable(); // JSON array of roles like ["admin", "superuser"] or null for guest/everyone
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frontend_menus');
    }
};

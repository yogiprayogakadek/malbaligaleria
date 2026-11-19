<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pet_polls', function (Blueprint $table) {
            $table->string('sender_email', 150)->nullable()->after('pet_scope');
            $table->string('sender_name', 100)->nullable()->after('sender_email');
        });
    }

    public function down(): void
    {
        Schema::table('pet_polls', function (Blueprint $table) {
            $table->dropColumn(['sender_email', 'sender_name']);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pet_poll_responses', function (Blueprint $table) {
            $table->string('email', 150)->nullable()->after('note');
            $table->string('edit_token', 64)->nullable()->unique()->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('pet_poll_responses', function (Blueprint $table) {
            $table->dropColumn(['email', 'edit_token']);
        });
    }
};

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
        Schema::table('events', function (Blueprint $table) {
            $table->enum('type', ['regular', 'special', 'exhibition', 'upcoming'])->default('upcoming')->after('name');
        });

        // Migrate existing data
        DB::table('events')->where('is_regular', true)->update(['type' => 'regular']);
        DB::table('events')->where('is_exhibition', true)->update(['type' => 'exhibition']);
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};

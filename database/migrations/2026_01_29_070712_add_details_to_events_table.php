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
            $table->string('location')->nullable()->after('description');
            $table->string('organizer')->nullable()->after('location');
            $table->boolean('is_paid')->default(false)->after('organizer');
            $table->decimal('price', 15, 2)->nullable()->after('is_paid');
            $table->string('target_audience')->nullable()->after('price');
            $table->string('highlights')->nullable()->after('target_audience');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['location', 'organizer', 'is_paid', 'price', 'target_audience', 'highlights']);
        });
    }
};

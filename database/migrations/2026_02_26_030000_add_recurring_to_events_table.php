<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->boolean('is_regular')->default(false)->after('is_active');
            $table->json('recurring_days')->nullable()->after('is_regular');
            $table->string('recurring_label', 100)->nullable()->after('recurring_days');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['is_regular', 'recurring_days', 'recurring_label']);
        });
    }
};

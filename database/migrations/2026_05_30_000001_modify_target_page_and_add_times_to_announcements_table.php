<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->text('target_page')->nullable()->change();
            $table->time('start_time')->nullable()->after('active_dates');
            $table->time('end_time')->nullable()->after('start_time');
        });

        // Migrate existing target_page column values to JSON format
        $announcements = DB::table('announcements')->get();
        foreach ($announcements as $ann) {
            $val = $ann->target_page;
            if ($val) {
                // If it is already a json array, skip
                if (str_starts_with($val, '[') && str_ends_with($val, ']')) {
                    continue;
                }
                DB::table('announcements')
                    ->where('id', $ann->id)
                    ->update(['target_page' => json_encode([$val])]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back target_page values from JSON to first element if possible
        $announcements = DB::table('announcements')->get();
        foreach ($announcements as $ann) {
            $val = $ann->target_page;
            if ($val) {
                $decoded = json_decode($val, true);
                if (is_array($decoded) && !empty($decoded)) {
                    DB::table('announcements')
                        ->where('id', $ann->id)
                        ->update(['target_page' => $decoded[0]]);
                }
            }
        }

        Schema::table('announcements', function (Blueprint $table) {
            $table->string('target_page', 50)->default('all')->change();
            $table->dropColumn(['start_time', 'end_time']);
        });
    }
};

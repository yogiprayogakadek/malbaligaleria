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
        Schema::table('job_vacancies', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
        });

        // Populate existing records
        $vacancies = \DB::table('job_vacancies')->get();
        foreach ($vacancies as $vacancy) {
            $slug = \Illuminate\Support\Str::slug($vacancy->title);
            $originalSlug = $slug;
            $count = 1;
            while (\DB::table('job_vacancies')->where('slug', $slug)->where('id', '!=', $vacancy->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            \DB::table('job_vacancies')->where('id', $vacancy->id)->update(['slug' => $slug]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_vacancies', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};

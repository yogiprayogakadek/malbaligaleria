<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update enum status to include 'interview' and 'on_hold'
        // For MySQL, we usually use DB::statement because change() on enum is tricky with Doctrine
        DB::statement("ALTER TABLE job_applications MODIFY COLUMN status ENUM('new', 'reviewed', 'interview', 'accepted', 'rejected', 'on_hold') NOT NULL DEFAULT 'new'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE job_applications MODIFY COLUMN status ENUM('new', 'reviewed', 'accepted', 'rejected') NOT NULL DEFAULT 'new'");
    }
};

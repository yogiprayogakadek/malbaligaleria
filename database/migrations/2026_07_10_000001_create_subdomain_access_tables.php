<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subdomain_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();       // user diberi akses
            $table->string('subdomain', 50);                       // e.g. 'inventory'
            $table->boolean('is_active')->default(true);
            $table->timestamp('expires_at')->nullable();           // null = tidak ada expired
            $table->string('note')->nullable();                    // catatan dari superuser
            $table->unsignedBigInteger('granted_by')->nullable()->index(); // superuser yang memberi
            $table->timestamps();

            $table->unique(['user_id', 'subdomain']);              // satu user satu record per subdomain
        });

        Schema::create('ip_whitelists', function (Blueprint $table) {
            $table->id();
            $table->string('subdomain', 50)->index();              // e.g. 'inventory'
            $table->string('ip_address', 45);                      // IPv4 or IPv6
            $table->string('label')->nullable();                   // e.g. "Kantor Pusat"
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('created_by')->nullable()->index();
            $table->timestamps();

            $table->unique(['subdomain', 'ip_address']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ip_whitelists');
        Schema::dropIfExists('subdomain_users');
    }
};

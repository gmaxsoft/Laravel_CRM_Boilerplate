<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Uruchom migracje.
     */
    public function up(): void
    {
        Schema::create('crm_cron_log', function (Blueprint $table) {
            $table->id('cron_id');
            $table->enum('cron_site', ['crm', 'maszyny']);
            $table->dateTime('cron_created_at')->nullable();
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_cron_log');
    }
};

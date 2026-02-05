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
        Schema::create('crm_www_contact_settings', function (Blueprint $table) {
            $table->id('www_id');
            $table->text('www_aditional')->nullable();
            $table->string('www_title', 300)->nullable();
            $table->dateTime('www_created_at');
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_www_contact_settings');
    }
};

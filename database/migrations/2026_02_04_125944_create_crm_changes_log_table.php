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
        Schema::create('crm_changes_log', function (Blueprint $table) {
            $table->id('log_id');
            $table->string('log_field_default', 200)->nullable();
            $table->string('log_field_changed', 200)->nullable();
            $table->dateTime('log_created_at')->nullable();
            $table->dateTime('log_updated_at')->nullable();
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_changes_log');
    }
};

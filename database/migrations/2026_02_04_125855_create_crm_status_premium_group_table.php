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
        Schema::create('crm_status_premium_group', function (Blueprint $table) {
            $table->id();
            $table->string('value', 100)->nullable();
            $table->string('name', 100)->nullable();
            $table->integer('position')->nullable();
            $table->index('position');
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_status_premium_group');
    }
};

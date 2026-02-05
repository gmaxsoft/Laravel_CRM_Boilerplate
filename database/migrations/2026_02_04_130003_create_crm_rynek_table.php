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
        Schema::create('crm_rynek', function (Blueprint $table) {
            $table->id('stat_id');
            $table->string('stat_rynek', 100)->nullable();
            $table->dateTime('stat_updated_at')->nullable();
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_rynek');
    }
};

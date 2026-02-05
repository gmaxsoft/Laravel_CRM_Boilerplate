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
        Schema::create('crm_county', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200)->nullable();
            $table->string('area', 100);
            $table->integer('position')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('update_at')->nullable();
            $table->index('position');
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_county');
    }
};

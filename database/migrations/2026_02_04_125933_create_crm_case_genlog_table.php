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
        Schema::create('crm_case_genlog', function (Blueprint $table) {
            $table->id();
            $table->string('title', 800)->nullable();
            $table->text('txt')->nullable();
            $table->dateTime('create_at')->nullable();
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_case_genlog');
    }
};

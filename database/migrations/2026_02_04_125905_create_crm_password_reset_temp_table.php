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
        Schema::create('crm_password_reset_temp', function (Blueprint $table) {
            $table->id();
            $table->string('email', 250)->nullable();
            $table->string('code', 250)->nullable();
            $table->dateTime('expDate');
            $table->index('code');
            $table->index('email');
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_password_reset_temp');
    }
};

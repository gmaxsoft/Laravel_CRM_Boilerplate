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
        Schema::create('crm_form_contact_settings', function (Blueprint $table) {
            $table->id('form_id');
            $table->enum('form_send', ['Nie', 'Tak', ''])->nullable();
            $table->string('form_email1', 80)->nullable();
            $table->string('form_email2', 80)->nullable();
            $table->string('form_email3', 80)->nullable();
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_form_contact_settings');
    }
};

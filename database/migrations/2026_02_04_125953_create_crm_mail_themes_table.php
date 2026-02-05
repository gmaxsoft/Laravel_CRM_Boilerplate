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
        Schema::create('crm_mail_themes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 600)->nullable();
            $table->string('subject', 800)->nullable();
            $table->text('content')->nullable();
            $table->string('bcc', 80)->nullable();
            $table->integer('position')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('update_at')->nullable();
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_mail_themes');
    }
};

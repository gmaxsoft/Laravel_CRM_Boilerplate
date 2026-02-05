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
        Schema::create('crm_emails_log', function (Blueprint $table) {
            $table->id();
            $table->integer('case_id')->nullable();
            $table->string('email_status', 100)->nullable();
            $table->string('email_to', 120)->nullable();
            $table->text('error')->nullable();
            $table->dateTime('sent_at')->nullable();
            $table->index('case_id');
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_emails_log');
    }
};

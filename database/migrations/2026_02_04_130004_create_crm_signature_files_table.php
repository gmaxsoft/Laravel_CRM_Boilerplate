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
        Schema::create('crm_signature_files', function (Blueprint $table) {
            $table->id('file_id');
            $table->string('file_name', 500)->nullable();
            $table->integer('file_size')->nullable();
            $table->string('file_type', 100)->nullable();
            $table->integer('file_user_id')->nullable();
            $table->dateTime('file_create_at')->nullable();
            $table->index('file_user_id');
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_signature_files');
    }
};

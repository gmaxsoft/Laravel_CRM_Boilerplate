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
        Schema::create('crm_mail_themes_files', function (Blueprint $table) {
            $table->id('file_id');
            $table->string('file_name', 80)->nullable();
            $table->string('file_type', 80)->nullable();
            $table->integer('file_size')->nullable();
            $table->integer('file_case_id')->nullable();
            $table->integer('file_position')->default(0);
            $table->dateTime('file_adddate')->nullable();
            $table->index('file_position');
            $table->index('file_case_id');
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_mail_themes_files');
    }
};

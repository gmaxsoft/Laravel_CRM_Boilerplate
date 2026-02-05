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
        Schema::create('crm_case_files', function (Blueprint $table) {
            $table->id('file_id');
            $table->string('file_name', 180)->nullable();
            $table->string('file_type', 80)->nullable();
            $table->integer('file_size')->nullable();
            $table->integer('file_case_id')->nullable();
            $table->integer('file_adv_id')->nullable();
            $table->integer('file_customers_id')->nullable();
            $table->tinyInteger('file_doc_type')->nullable();
            $table->dateTime('file_adddate')->nullable();
            $table->index('file_case_id');
            $table->index('file_adv_id');
            $table->index('file_customers_id');
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_case_files');
    }
};

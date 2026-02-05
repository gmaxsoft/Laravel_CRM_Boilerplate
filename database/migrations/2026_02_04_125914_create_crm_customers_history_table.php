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
        Schema::create('crm_customers_history', function (Blueprint $table) {
            $table->id('history_id');
            $table->string('history_name', 700)->nullable();
            $table->string('history_type', 700)->nullable();
            $table->text('history_additional')->nullable();
            $table->integer('history_customerid')->nullable();
            $table->integer('history_caseid')->nullable();
            $table->integer('history_user_id')->nullable();
            $table->integer('history_case_advid')->nullable();
            $table->dateTime('history_adddate')->nullable();
            $table->dateTime('history_update')->nullable();
            $table->index('history_customerid');
            $table->index('history_caseid');
            $table->index('history_case_advid');
            $table->index('history_user_id');
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_customers_history');
    }
};

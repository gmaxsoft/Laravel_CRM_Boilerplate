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
        Schema::create('crm_case_tokens', function (Blueprint $table) {
            $table->id('token_id');
            $table->integer('token_user_id')->nullable();
            $table->integer('token_case_id')->nullable();
            $table->integer('token_adv_id')->nullable();
            $table->integer('token_customers_id')->nullable();
            $table->integer('token_trader_id')->nullable();
            $table->string('token_token', 255)->nullable();
            $table->enum('token_status', ['0', '1'])->nullable();
            $table->string('token_type', 100)->nullable();
            $table->tinyInteger('token_doc_type')->nullable();
            $table->tinyInteger('token_gen')->nullable();
            $table->tinyInteger('token_rodo')->nullable();
            $table->date('token_expire_at')->nullable();
            $table->dateTime('token_opened_at')->nullable();
            $table->dateTime('token_created_at')->nullable();
            $table->index('token_adv_id');
            $table->index('token_case_id');
            $table->index('token_customers_id');
            $table->index('token_user_id');
            $table->index('token_status');
            $table->index('token_trader_id');
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_case_tokens');
    }
};

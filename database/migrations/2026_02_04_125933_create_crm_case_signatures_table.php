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
        Schema::create('crm_case_signatures', function (Blueprint $table) {
            $table->id('sign_id');
            $table->string('sign_user_name', 80)->nullable();
            $table->string('sign_firm_name', 120)->nullable();
            $table->integer('sign_case_id')->nullable();
            $table->integer('sign_adv_id')->nullable();
            $table->integer('sign_customers_id')->nullable();
            $table->text('sign_sign')->nullable();
            $table->string('sign_token', 255)->nullable();
            $table->enum('sign_rodo', ['Nie', 'Tak'])->nullable();
            $table->string('sign_rodo_umowa', 100)->nullable();
            $table->string('sign_rodo_marketing', 100)->nullable();
            $table->string('sign_type', 100)->nullable();
            $table->tinyInteger('sign_doc_type')->nullable();
            $table->dateTime('sign_created_at')->nullable();
            $table->dateTime('sign_updated_at')->nullable();
            $table->index('sign_case_id');
            $table->index('sign_adv_id');
            $table->index('sign_customers_id');
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_case_signatures');
    }
};

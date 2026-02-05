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
        Schema::create('crm_trader_signature', function (Blueprint $table) {
            $table->id('sign_id');
            $table->string('sign_user_name', 80)->nullable();
            $table->text('sign_sign')->nullable();
            $table->integer('sign_user_id')->nullable();
            $table->dateTime('sign_created_at')->nullable();
            $table->dateTime('sign_updated_at')->nullable();
            $table->index('sign_user_id');
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_trader_signature');
    }
};

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
        Schema::create('crm_leeds_waiting_room', function (Blueprint $table) {
            $table->id('form_id');
            $table->string('form_name', 400)->nullable();
            $table->string('form_phone', 80)->nullable();
            $table->string('form_email', 80)->nullable();
            $table->text('form_message')->nullable();
            $table->string('form_area', 80)->nullable();
            $table->string('form_county', 200)->nullable();
            $table->enum('form_status', ['0', '1', '2'])->nullable();
            $table->string('form_website', 100)->nullable();
            $table->integer('form_adv_id')->nullable();
            $table->integer('form_customer_id')->nullable();
            $table->dateTime('form_create_at')->nullable();
            $table->dateTime('form_update_at')->nullable();
            $table->index('form_adv_id');
            $table->index('form_customer_id');
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_leeds_waiting_room');
    }
};

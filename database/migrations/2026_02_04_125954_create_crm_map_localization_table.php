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
        Schema::create('crm_map_localization', function (Blueprint $table) {
            $table->id('map_id');
            $table->integer('map_customer_id')->nullable();
            $table->integer('map_adv_id')->nullable();
            $table->integer('map_case_id')->nullable();
            $table->integer('map_trader_id')->nullable();
            $table->string('map_adress', 300)->nullable();
            $table->string('map_title', 300)->nullable();
            $table->string('map_url', 100)->nullable();
            $table->string('map_username', 300)->nullable();
            $table->string('map_machine_name', 300)->nullable();
            $table->enum('map_type', ['0', '1', '2']);
            $table->dateTime('map_created_at')->nullable();
            $table->dateTime('map_updated_at')->nullable();
            $table->index('map_adv_id');
            $table->index('map_customer_id');
            $table->index('map_case_id');
            $table->index('map_trader_id');
            $table->index('map_title');
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_map_localization');
    }
};

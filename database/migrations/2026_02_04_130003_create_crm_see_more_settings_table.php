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
        Schema::create('crm_see_more_settings', function (Blueprint $table) {
            $table->id('see_id');
            $table->string('see_long_title', 450)->nullable();
            $table->text('see_long_text')->nullable();
            $table->string('see_first', 450)->nullable();
            $table->string('see_second', 450)->nullable();
            $table->string('see_third', 450)->nullable();
            $table->string('see_four', 450)->nullable();
            $table->text('see_footer_text')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('update_at');
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_see_more_settings');
    }
};

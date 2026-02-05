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
        Schema::create('crm_calendar', function (Blueprint $table) {
            $table->id('cal_id');
            $table->string('cal_name', 400)->nullable();
            $table->string('cal_category', 100)->nullable();
            $table->dateTime('cal_start')->nullable();
            $table->dateTime('cal_end')->nullable();
            $table->text('cal_annotations')->nullable();
            $table->integer('cal_user_id')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('update_at')->nullable();
            $table->index('cal_user_id');
            $table->index('cal_category');
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_calendar');
    }
};

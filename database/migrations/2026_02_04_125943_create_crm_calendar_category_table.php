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
        Schema::create('crm_calendar_category', function (Blueprint $table) {
            $table->id('cal_cat_id');
            $table->string('cal_cat_name', 400);
            $table->string('cal_cat_value', 100);
            $table->string('cal_cat_color', 100);
            $table->integer('cal_cat_position');
            $table->dateTime('cal_created_at');
            $table->dateTime('cal_update_at');
            $table->index('cal_cat_position');
            $table->index('cal_cat_value');
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_calendar_category');
    }
};

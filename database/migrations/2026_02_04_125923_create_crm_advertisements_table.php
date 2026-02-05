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
        Schema::create('crm_advertisements', function (Blueprint $table) {
            $table->id('adv_id');
            $table->enum('adv_active', ['0', '1'])->nullable();
            $table->integer('adv_file_umowa_id')->nullable();
            $table->string('adv_status', 100)->nullable();
            $table->string('adv_client_name', 600)->nullable();
            $table->string('adv_client_phone', 16)->nullable();
            $table->string('adv_client_email', 80)->nullable();
            $table->string('adv_machine_name', 200)->nullable();
            $table->string('adv_machine_type', 200)->nullable();
            $table->string('adv_producer', 300)->nullable();
            $table->string('adv_model', 300)->nullable();
            $table->string('adv_year', 30)->nullable();
            $table->string('adv_power', 100)->nullable();
            $table->string('adv_maxpower', 100)->nullable();
            $table->string('adv_gear', 200)->nullable();
            $table->string('adv_mileage', 100)->nullable();
            $table->string('adv_capacity', 100)->nullable();
            $table->string('adv_price', 100)->nullable();
            $table->string('adv_price_netto', 100)->nullable();
            $table->longText('adv_additional')->nullable();
            $table->string('adv_location', 300)->nullable();
            $table->string('adv_country', 100)->nullable();
            $table->integer('adv_position')->nullable();
            $table->integer('adv_trader_id')->nullable();
            $table->integer('adv_user_id')->nullable();
            $table->string('adv_trader_name', 110)->nullable();
            $table->string('adv_internal_order_number', 100)->nullable();
            $table->string('adv_producer_order_number', 100)->nullable();
            $table->string('adv_serial_number', 100)->nullable();
            $table->string('adv_state', 100)->nullable();
            $table->date('adv_production_date')->nullable();
            $table->text('adv_comments')->nullable();
            $table->text('adv_comments_additional')->nullable();
            $table->text('adv_comments_info')->nullable();
            $table->string('adv_register', 100)->nullable();
            $table->enum('adv_register_info', ['Nie', 'Tak'])->nullable();
            $table->date('adv_warranty_start')->nullable();
            $table->date('adv_warranty_end')->nullable();
            $table->tinyInteger('adv_reservation')->nullable();
            $table->integer('adv_reservation_user_id')->nullable();
            $table->date('adv_reservation_exp_date')->nullable();
            $table->tinyInteger('adv_reservation_crone_flag')->nullable();
            $table->enum('adv_magazyn_type', ['0', '1'])->nullable();
            $table->string('adv_fv_nr', 155)->nullable();
            $table->string('adv_source', 100)->nullable();
            $table->enum('adv_demo', ['0', '1'])->nullable();
            $table->enum('adv_promo', ['0', '1'])->nullable();
            $table->enum('adv_warranty', ['0', '1'])->nullable();
            $table->enum('adv_finances', ['0', '1'])->nullable();
            $table->date('adv_exp_date')->nullable();
            $table->date('adv_order_date')->nullable();
            $table->string('adv_order_price', 100)->nullable();
            $table->string('adv_status_deal', 100)->nullable();
            $table->dateTime('adv_created_at')->nullable();
            $table->dateTime('adv_update_at')->nullable();

            $table->index('adv_machine_type');
            $table->index('adv_machine_name');
            $table->index('adv_model');
            $table->index('adv_producer');
            $table->index('adv_trader_id');
            $table->index('adv_position');
            $table->index('adv_user_id');
            $table->index('adv_magazyn_type');
            $table->index('adv_reservation');
            $table->index('adv_created_at');
            $table->index('adv_register');
            $table->index('adv_active');
            $table->index('adv_status');
            $table->index('adv_file_umowa_id');
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_advertisements');
    }
};

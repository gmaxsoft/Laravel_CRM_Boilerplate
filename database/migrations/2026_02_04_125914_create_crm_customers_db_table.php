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
        Schema::create('crm_customers_db', function (Blueprint $table) {
            $table->id('customers_id');
            $table->integer('customers_code')->nullable();
            $table->string('customers_firmname', 300)->nullable();
            $table->string('customers_firstname', 150)->nullable();
            $table->string('customers_lastname', 150)->nullable();
            $table->string('customers_name', 150)->nullable();
            $table->string('customers_city', 150)->nullable();
            $table->string('customers_postcode', 50)->nullable();
            $table->string('customers_adres', 300)->nullable();
            $table->string('customers_area', 80)->nullable();
            $table->string('customers_phone', 25)->nullable();
            $table->string('customers_email', 80)->nullable();
            $table->string('customers_regon', 25)->nullable();
            $table->string('customers_nip', 25)->nullable();
            $table->string('customers_krs', 80)->nullable();
            $table->string('customers_legalform', 180)->nullable();
            $table->string('customers_country', 100)->nullable();
            $table->string('customers_county', 120)->nullable();
            $table->string('customers_agricultural_land', 150)->nullable();
            $table->string('customers_community', 200)->nullable();
            $table->string('customers_postoffice', 200)->nullable();
            $table->string('customers_employment', 150)->nullable();
            $table->string('customers_vehicles', 150)->nullable();
            $table->string('customers_rodo', 25)->nullable();
            $table->string('customers_status', 150)->nullable();
            $table->text('customers_aditional')->nullable();
            $table->longText('customers_case_aditional')->nullable();
            $table->string('customers_taskstatus', 100)->nullable();
            $table->string('customers_work_status', 30)->nullable();
            $table->tinyInteger('customers_task_id')->nullable();
            $table->date('customers_re_contact_date')->nullable();
            $table->tinyInteger('customers_re_contact_date_cron')->nullable();
            $table->integer('customers_trader_id')->nullable();
            $table->string('customers_pass', 260)->nullable();
            $table->string('customers_activation_code', 260)->nullable();
            $table->enum('customers_active', ['0', '1']);
            $table->enum('customers_type', ['0', '1']);
            $table->tinyInteger('customers_sp_email')->nullable();
            $table->tinyInteger('customers_sp_sms')->nullable();
            $table->tinyInteger('customers_sp_phone')->nullable();
            $table->tinyInteger('customers_sp_postoffice')->nullable();
            $table->date('customers_task_date')->nullable();
            $table->date('customers_task_date_termin')->nullable();
            $table->dateTime('customers_adddate')->nullable();
            $table->dateTime('customers_update')->nullable();
            $table->tinyInteger('customers_double')->nullable();

            $table->index('customers_code');
            $table->index('customers_nip');
            $table->index('customers_email');
            $table->index('customers_trader_id');
            $table->index('customers_adddate');
            $table->index('customers_phone');
            $table->index('customers_task_id');
            $table->index('customers_type');
            $table->index('customers_active');
            $table->index('customers_re_contact_date');
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_customers_db');
    }
};

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
        Schema::create('crm_documents', function (Blueprint $table) {
            $table->id('doc_id');
            $table->integer('doc_adv_id')->nullable();
            $table->integer('doc_customers_id')->nullable();
            $table->string('doc_machine_name', 200)->nullable();
            $table->string('doc_firmname', 200)->nullable();
            $table->string('doc_firstname', 200)->nullable();
            $table->string('doc_lastname', 200)->nullable();
            $table->string('doc_name', 300)->nullable();
            $table->string('doc_phone', 16)->nullable();
            $table->string('doc_email', 80)->nullable();
            $table->string('doc_city', 200)->nullable();
            $table->string('doc_postcode', 200)->nullable();
            $table->string('doc_adres', 340)->nullable();
            $table->integer('doc_nip')->nullable();
            $table->date('doc_deal_date')->nullable();
            $table->string('doc_city_deal', 200)->nullable();
            $table->date('doc_future_date')->nullable();
            $table->tinyInteger('doc_machine_type')->nullable();
            $table->tinyInteger('doc_producer')->nullable();
            $table->string('doc_register', 200)->nullable();
            $table->string('doc_year', 4)->nullable();
            $table->string('doc_model', 200)->nullable();
            $table->string('doc_serial_number', 200)->nullable();
            $table->integer('doc_mileage')->nullable();
            $table->text('doc_other')->nullable();
            $table->text('doc_additional')->nullable();
            $table->text('doc_additional_out')->nullable();
            $table->text('doc_additional_najem')->nullable();
            $table->string('doc_return_adress', 300)->nullable();
            $table->date('doc_date_od')->nullable();
            $table->date('doc_date_do')->nullable();
            $table->string('doc_rent_netto', 100)->nullable();
            $table->string('doc_rent_loan_netto', 100)->nullable();
            $table->string('doc_rent_loan_brutto', 100)->nullable();
            $table->string('doc_buyout_netto', 100)->nullable();
            $table->string('doc_price_netto', 100)->nullable();
            $table->string('doc_price_brutto', 200)->nullable();
            $table->string('doc_price_procent', 100)->nullable();
            $table->string('doc_low_price_procent', 100)->nullable();
            $table->integer('doc_trader_id')->nullable();
            $table->string('doc_type', 200)->nullable();
            $table->tinyInteger('doc_gen')->nullable();
            $table->string('doc_fuel', 100)->nullable();
            $table->tinyInteger('doc_token_rodo')->nullable();
            $table->tinyInteger('doc_sp_email')->nullable();
            $table->tinyInteger('doc_sp_sms')->nullable();
            $table->tinyInteger('doc_sp_phone')->nullable();
            $table->tinyInteger('doc_sp_postoffice')->nullable();
            $table->string('doc_send_status', 100)->nullable();
            $table->dateTime('doc_created_at')->nullable();
            $table->dateTime('doc_update_at')->nullable();
            $table->index('doc_adv_id');
            $table->index('doc_customers_id');
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_documents');
    }
};

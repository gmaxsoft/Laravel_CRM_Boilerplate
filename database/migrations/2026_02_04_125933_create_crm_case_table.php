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
        Schema::create('crm_case', function (Blueprint $table) {
            $table->id('case_id');
            $table->string('case_title', 600)->nullable();
            $table->string('case_name', 600)->nullable();
            $table->string('case_firstname', 200)->nullable();
            $table->string('case_lastname', 200)->nullable();
            $table->string('case_adres', 800)->nullable();
            $table->string('case_city', 600)->nullable();
            $table->string('case_city_deal', 300)->nullable();
            $table->string('case_area', 100)->nullable();
            $table->string('case_postcode', 100)->nullable();
            $table->string('case_county', 200)->nullable();
            $table->integer('case_trader_id')->nullable();
            $table->string('case_source_from', 100)->nullable();
            $table->integer('case_supervisor_id')->nullable();
            $table->integer('case_customer_id')->nullable();
            $table->integer('case_author_id')->nullable();
            $table->string('case_source', 300)->nullable();
            $table->string('case_phone', 12)->nullable();
            $table->string('case_email', 80)->nullable();
            $table->integer('case_machine_type')->nullable();
            $table->string('case_brand', 150)->nullable();
            $table->string('case_model', 100)->nullable();
            $table->string('case_nrseria', 200)->nullable();
            $table->string('case_amount', 100)->nullable();
            $table->string('case_amount_ams', 100)->nullable();
            $table->date('case_re_contact_date')->nullable();
            $table->string('case_re_contact_date_real', 100)->nullable();
            $table->tinyInteger('case_re_contact_date_cron')->nullable();
            $table->string('case_status', 120)->nullable();
            $table->text('case_aditional')->nullable();
            $table->text('case_aneks')->nullable();
            $table->tinyInteger('case_lead')->nullable();
            $table->tinyInteger('case_offer')->nullable();
            $table->tinyInteger('case_win')->nullable();
            $table->date('case_adddate')->nullable();
            $table->date('case_expiration_data')->nullable();
            $table->integer('case_file_id')->nullable();
            $table->integer('case_file_umowa_id')->nullable();
            $table->integer('case_adv_id')->nullable();
            $table->text('case_adv_data')->nullable();
            $table->date('case_data_fv')->nullable();
            $table->date('case_deal_date')->nullable();
            $table->integer('case_nrfv')->nullable();
            $table->string('case_amount_purchase', 100)->nullable();
            $table->string('case_service_assignments', 100)->nullable();
            $table->string('case_rwmr', 100)->nullable();
            $table->text('case_summary_description')->nullable();
            $table->string('case_premium_group', 100)->nullable();
            $table->string('case_rw', 110)->nullable();
            $table->string('case_ams', 100)->nullable();
            $table->string('case_prepared', 100)->nullable();
            $table->string('case_amount_prepared', 100)->nullable();
            $table->string('case_serwis_nr', 200)->nullable();
            $table->text('case_description')->nullable();
            $table->string('case_price_other', 100)->nullable();
            $table->text('case_correction_description')->nullable();
            $table->string('case_correction_amount', 100)->nullable();
            $table->string('case_total_cost', 100)->nullable();
            $table->string('case_margin', 600)->nullable();
            $table->string('case_correction_margin', 100)->nullable();
            $table->string('case_group', 100)->nullable();
            $table->string('case_trader_bonus', 100)->nullable();
            $table->string('case_manager_bonus', 100)->nullable();
            $table->string('case_margin_percent', 100)->nullable();
            $table->string('case_deadline_days', 100)->nullable();
            $table->string('case_interest', 100)->nullable();
            $table->string('case_interest_amount', 100)->nullable();
            $table->string('case_complete_documentation', 100)->nullable();
            $table->string('case_trader_bonus_pln', 100)->nullable();
            $table->string('case_menager_bonus_pln', 100)->nullable();
            $table->string('case_price_netto', 100)->nullable();
            $table->string('case_price_brutto', 100)->nullable();
            $table->string('case_currency', 100)->nullable();
            $table->string('case_nip', 80)->nullable();
            $table->string('case_zadatek', 100)->nullable();
            $table->string('case_deal_termin', 200)->nullable();
            $table->string('case_status_deal', 100)->nullable();
            $table->date('case_warranty_start')->nullable();
            $table->date('case_warranty_end')->nullable();
            $table->text('case_gen_spec')->nullable();
            $table->text('case_gen_additional')->nullable();
            $table->text('case_gen_additional_info')->nullable();
            $table->tinyInteger('case_magazyn_type')->nullable();
            $table->tinyInteger('case_zadatek_switch')->nullable();
            $table->tinyInteger('case_aneks_switch')->nullable();
            $table->tinyInteger('case_foto_switch')->nullable();
            $table->tinyInteger('case_change_data_switch')->nullable();
            $table->tinyInteger('case_open_flag')->nullable();
            $table->dateTime('case_created_at')->nullable();
            $table->dateTime('case_update_at')->nullable();

            $table->index('case_trader_id');
            $table->index('case_status');
            $table->index('case_adddate');
            $table->index('case_source');
            $table->index('case_customer_id');
            $table->index('case_adv_id');
            $table->index('case_machine_type');
            $table->index('case_magazyn_type');
            $table->index('case_re_contact_date');
            $table->index('case_supervisor_id');
        });
    }

    /**
     * Cofnij migracje.
     */
    public function down(): void
    {
        Schema::dropIfExists('crm_case');
    }
};

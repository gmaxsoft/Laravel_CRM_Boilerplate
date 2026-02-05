<?php

namespace Modules\Documents\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'crm_documents';

    protected $fillable = [
        'doc_adv_id',
        'doc_customers_id',
        'doc_machine_name',
        'doc_firmname',
        'doc_firstname',
        'doc_lastname',
        'doc_name',
        'doc_phone',
        'doc_email',
        'doc_city',
        'doc_postcode',
        'doc_adres',
        'doc_nip',
        'doc_deal_date',
        'doc_city_deal',
        'doc_future_date',
        'doc_machine_type',
        'doc_producer',
        'doc_register',
        'doc_year',
        'doc_model',
        'doc_serial_number',
        'doc_mileage',
        'doc_other',
        'doc_additional',
        'doc_additional_out',
        'doc_additional_najem',
        'doc_return_adress',
        'doc_date_od',
        'doc_date_do',
        'doc_rent_netto',
        'doc_rent_loan_netto',
        'doc_rent_loan_brutto',
        'doc_buyout_netto',
        'doc_price_netto',
        'doc_price_brutto',
        'doc_price_procent',
        'doc_low_price_procent',
        'doc_trader_id',
        'doc_type',
        'doc_gen',
        'doc_fuel',
        'doc_token_rodo',
        'doc_sp_email',
        'doc_sp_sms',
        'doc_sp_phone',
        'doc_sp_postoffice',
        'doc_send_status',
        'doc_created_at',
        'doc_update_at',
    ];

    public $timestamps = false;
}

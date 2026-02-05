<?php

namespace Modules\Customers\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Users\Models\User;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'crm_customers_db';

    protected $primaryKey = 'customers_id';

    public $timestamps = false;

    protected $fillable = [
        'customers_code',
        'customers_firmname',
        'customers_firstname',
        'customers_lastname',
        'customers_phone',
        'customers_email',
        'customers_adres',
        'customers_city',
        'customers_postcode',
        'customers_area',
        'customers_county',
        'customers_community',
        'customers_postoffice',
        'customers_country',
        'customers_regon',
        'customers_nip',
        'customers_krs',
        'customers_legalform',
        'customers_agricultural_land',
        'customers_rodo',
        'customers_aditional',
        'customers_trader_id',
        'customers_re_contact_date',
        'customers_sp_email',
        'customers_sp_sms',
        'customers_sp_phone',
        'customers_sp_postoffice',
        'customers_active',
        'customers_type',
        'customers_adddate',
        'customers_update',
    ];

    public function trader(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'customers_trader_id', 'id');
    }

    protected static function newFactory(): \Modules\Customers\Database\Factories\CustomerFactory
    {
        return \Modules\Customers\Database\Factories\CustomerFactory::new();
    }
}

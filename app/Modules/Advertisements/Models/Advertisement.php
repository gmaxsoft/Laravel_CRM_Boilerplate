<?php

namespace Modules\Advertisements\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Users\Models\User;

class Advertisement extends Model
{
    protected $table = 'crm_advertisements';

    protected $primaryKey = 'adv_id';

    protected $fillable = [
        'adv_active',
        'adv_file_umowa_id',
        'adv_status',
        'adv_client_name',
        'adv_client_phone',
        'adv_client_email',
        'adv_machine_name',
        'adv_machine_type',
        'adv_producer',
        'adv_model',
        'adv_year',
        'adv_power',
        'adv_maxpower',
        'adv_gear',
        'adv_mileage',
        'adv_capacity',
        'adv_price',
        'adv_price_netto',
        'adv_additional',
        'adv_location',
        'adv_country',
        'adv_position',
        'adv_trader_id',
        'adv_user_id',
        'adv_trader_name',
        'adv_internal_order_number',
        'adv_producer_order_number',
        'adv_serial_number',
        'adv_state',
        'adv_production_date',
        'adv_comments',
        'adv_comments_additional',
        'adv_comments_info',
        'adv_register',
        'adv_register_info',
        'adv_warranty_start',
        'adv_warranty_end',
        'adv_reservation',
        'adv_reservation_user_id',
        'adv_reservation_exp_date',
        'adv_reservation_crone_flag',
        'adv_magazyn_type',
        'adv_fv_nr',
        'adv_source',
        'adv_demo',
        'adv_promo',
        'adv_warranty',
        'adv_finances',
        'adv_exp_date',
        'adv_order_date',
        'adv_order_price',
        'adv_status_deal',
        'adv_created_at',
        'adv_update_at',
    ];

    public $timestamps = false;

    public function reservationUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'adv_reservation_user_id', 'id');
    }
}

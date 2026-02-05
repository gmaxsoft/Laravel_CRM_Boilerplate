<?php

namespace Modules\Logs\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerHistory extends Model
{
    protected $table = 'crm_customers_history';

    protected $fillable = [
        'history_name',
        'history_type',
        'history_additional',
        'history_customerid',
        'history_caseid',
        'history_user_id',
        'history_case_advid',
        'history_adddate',
        'history_update',
    ];

    public $timestamps = false;
}

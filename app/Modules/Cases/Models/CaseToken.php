<?php

namespace Modules\Cases\Models;

use Illuminate\Database\Eloquent\Model;

class CaseToken extends Model
{
    protected $table = 'crm_case_tokens';

    protected $fillable = [
        'token_user_id',
        'token_case_id',
        'token_adv_id',
        'token_customers_id',
        'token_trader_id',
        'token_token',
        'token_status',
        'token_type',
        'token_doc_type',
        'token_gen',
        'token_rodo',
        'token_expire_at',
        'token_opened_at',
        'token_created_at',
    ];

    public $timestamps = false;
}

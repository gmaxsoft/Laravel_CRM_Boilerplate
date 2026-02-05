<?php

namespace Modules\Cases\Models;

use Illuminate\Database\Eloquent\Model;

class CaseSignature extends Model
{
    protected $table = 'crm_case_signatures';

    protected $fillable = [
        'sign_user_name',
        'sign_firm_name',
        'sign_case_id',
        'sign_adv_id',
        'sign_customers_id',
        'sign_sign',
        'sign_token',
        'sign_rodo',
        'sign_rodo_umowa',
        'sign_rodo_marketing',
        'sign_type',
        'sign_doc_type',
        'sign_created_at',
        'sign_updated_at',
    ];

    public $timestamps = false;
}

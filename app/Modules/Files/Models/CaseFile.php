<?php

namespace Modules\Files\Models;

use Illuminate\Database\Eloquent\Model;

class CaseFile extends Model
{
    protected $table = 'crm_case_files';

    protected $fillable = [
        'file_name',
        'file_type',
        'file_size',
        'file_case_id',
        'file_adv_id',
        'file_customers_id',
        'file_doc_type',
        'file_adddate',
    ];

    public $timestamps = false;
}

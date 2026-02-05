<?php

namespace Modules\Logs\Models;

use Illuminate\Database\Eloquent\Model;

class CaseGenlog extends Model
{
    protected $table = 'crm_case_genlog';

    protected $fillable = [
        'title',
        'txt',
        'create_at',
    ];

    public $timestamps = false;
}

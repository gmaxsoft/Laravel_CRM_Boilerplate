<?php

namespace Modules\Logs\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    protected $table = 'crm_emails_log';

    protected $fillable = [
        'case_id',
        'email_status',
        'email_to',
        'error',
        'sent_at',
    ];

    public $timestamps = false;
}

<?php

namespace Modules\Logs\Models;

use Illuminate\Database\Eloquent\Model;

class CronLog extends Model
{
    protected $table = 'crm_cron_log';

    protected $fillable = [
        'cron_site',
        'cron_created_at',
    ];

    public $timestamps = false;
}

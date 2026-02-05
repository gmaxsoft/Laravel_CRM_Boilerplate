<?php

namespace Modules\Logs\Models;

use Illuminate\Database\Eloquent\Model;

class ChangesLog extends Model
{
    protected $table = 'crm_changes_log';

    protected $fillable = [
        'log_field_default',
        'log_field_changed',
        'log_created_at',
        'log_updated_at',
    ];

    public $timestamps = false;
}

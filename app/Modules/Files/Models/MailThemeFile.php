<?php

namespace Modules\Files\Models;

use Illuminate\Database\Eloquent\Model;

class MailThemeFile extends Model
{
    protected $table = 'crm_mail_themes_files';

    protected $fillable = [
        'file_name',
        'file_type',
        'file_size',
        'file_case_id',
        'file_position',
        'file_adddate',
    ];

    public $timestamps = false;
}

<?php

namespace Modules\Files\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertisementFile extends Model
{
    protected $table = 'crm_advertisements_files';

    protected $fillable = [
        'file_name',
        'file_type',
        'file_size',
        'file_advertisements_id',
        'file_case_id',
        'file_position',
        'file_adddate',
    ];

    public $timestamps = false;
}

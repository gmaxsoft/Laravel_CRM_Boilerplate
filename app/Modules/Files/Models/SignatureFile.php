<?php

namespace Modules\Files\Models;

use Illuminate\Database\Eloquent\Model;

class SignatureFile extends Model
{
    protected $table = 'crm_signature_files';

    protected $fillable = [
        'file_name',
        'file_size',
        'file_type',
        'file_user_id',
        'file_create_at',
    ];

    public $timestamps = false;
}

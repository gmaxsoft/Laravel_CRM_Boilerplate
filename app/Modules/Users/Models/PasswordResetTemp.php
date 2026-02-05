<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetTemp extends Model
{
    protected $table = 'crm_password_reset_temp';

    protected $fillable = [
        'email',
        'code',
        'expDate',
    ];

    public $timestamps = false;
}

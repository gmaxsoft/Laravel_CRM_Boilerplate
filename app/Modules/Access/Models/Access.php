<?php

namespace Modules\Access\Models;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    protected $table = 'crm_access';

    protected $fillable = [
        'name',
        'level',
        'position',
        'created_at',
        'update_at',
    ];

    public $timestamps = false;

    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\Modules\Users\Models\User::class, 'user_level', 'level');
    }
}

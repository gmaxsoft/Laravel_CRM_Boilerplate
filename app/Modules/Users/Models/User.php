<?php

namespace Modules\Users\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'crm_users';

    protected $fillable = [
        'first_name',
        'last_name',
        'stand_name',
        'symbol',
        'department',
        'description',
        'email',
        'phone',
        'password',
        'user_level',
        'active',
        'additional',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function access(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\Modules\Access\Models\Access::class, 'user_level', 'level');
    }

    protected static function newFactory(): \Modules\Users\Database\Factories\UserFactory
    {
        return \Modules\Users\Database\Factories\UserFactory::new();
    }
}

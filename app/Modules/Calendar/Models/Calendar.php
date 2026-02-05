<?php

namespace Modules\Calendar\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'crm_calendar';

    protected $primaryKey = 'cal_id';

    protected $fillable = [
        'cal_name',
        'cal_category',
        'cal_start',
        'cal_end',
        'cal_annotations',
        'cal_user_id',
        'created_at',
        'update_at',
    ];

    public $timestamps = false;

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\Modules\Users\Models\User::class, 'cal_user_id', 'id');
    }
}

<?php

namespace Modules\Calendar\Models;

use Illuminate\Database\Eloquent\Model;

class CalendarCategory extends Model
{
    protected $table = 'crm_calendar_category';

    protected $fillable = [
        'cal_cat_name',
        'cal_cat_value',
        'cal_cat_color',
        'cal_cat_position',
        'cal_created_at',
        'cal_update_at',
    ];

    public $timestamps = false;
}

<?php

namespace Modules\Documents\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Users\Models\User;

class DocumentFile extends Model
{
    protected $table = 'crm_document_files';

    protected $fillable = [
        'name',
        'original_name',
        'size',
        'mime_type',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getSizeForHumansAttribute(): string
    {
        $bytes = $this->size;
        $units = [' B', ' KB', ' MB', ' GB'];
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2).$units[$i];
    }
}

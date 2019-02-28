<?php

namespace App\Models;

class AccessLogs extends BaseModel
{
    protected $table = 'access_logs';
    protected $fillable = [
        'article_id',
        'ip',
        'country',
        'city'
    ];
    public const UPDATED_AT = null;
}

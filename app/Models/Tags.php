<?php

namespace App\Models;

class Tags extends BaseModel
{
    protected $table = 'tags';
    protected $fillable = [
        'title',
        'is_home',
        'status',
    ];
}

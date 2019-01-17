<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articles extends BaseModel
{
    protected $table = 'articles';
    protected $fillable = [
        'title',
        'desc',
        'is_home',
        'tag_id',
        'body',
        'read'
    ];
}

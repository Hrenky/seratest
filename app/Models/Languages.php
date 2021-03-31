<?php

namespace App\Models;

class Languages extends BaseModel
{
    protected $primaryKey = 'langID';

    public $timestamps = false;

    protected $fillable = [
        'language'
    ];
}

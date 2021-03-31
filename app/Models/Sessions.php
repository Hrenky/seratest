<?php

namespace App\Models;

class Sessions extends BaseModel
{
    protected $primaryKey = 'sessionID';

    public $timestamps = false;

    protected $fillable = [
        'userID',
        'agent',
        'token',
        'expire'
    ];
}

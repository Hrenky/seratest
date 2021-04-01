<?php

namespace App\Models;

/**
 * Class Sessions
 * @package App\Models
 */
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

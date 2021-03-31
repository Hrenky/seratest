<?php

namespace App\Models;

class Countries extends BaseModel
{
    protected $primaryKey = 'countryID';

    public $timestamps = false;

    protected $fillable = [
        'country'
    ];
}

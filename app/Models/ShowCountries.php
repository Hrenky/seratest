<?php

namespace App\Models;

class ShowCountries extends BaseModel
{
    protected $primaryKey = 'showCountryID';

    public $timestamps = false;

    protected $fillable = [
        'showID',
        'countryID'
    ];
}

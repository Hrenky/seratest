<?php

namespace App\Models;

class Crew extends BaseModel
{
    const DIRECTOR = 1;
    const WRITER = 2;
    const ACTOR = 3;

    protected $primaryKey = 'crewID';

    protected $table = 'crew';

    protected $fillable = [
        'name',
        'type'
    ];
}

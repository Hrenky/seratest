<?php

namespace App\Models;

class ShowCrew extends BaseModel
{
    protected $primaryKey = 'showCrewID';

    protected $table = 'show_crew';

    public $timestamps = false;

    protected $fillable = [
        'showID',
        'crewID'
    ];
}

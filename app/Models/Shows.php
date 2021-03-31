<?php

namespace App\Models;

class Shows extends BaseModel
{
    const MOVIE = 1;
    const SHOW = 2;
    const EPISODES = 3;

    protected $primaryKey = 'showID';

    protected $fillable = [
        'title',
        'year',
        'rated',
        'release',
        'length',
        'plot',
        'poster',
        'ratings',
        'type'
    ];
}

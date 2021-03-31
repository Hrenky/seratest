<?php

namespace App\Models;

class Genres extends BaseModel
{
    protected $primaryKey = 'genreID';

    public $timestamps = false;

    protected $fillable = [
        'genre'
    ];
}

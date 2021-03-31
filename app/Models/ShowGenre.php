<?php

namespace App\Models;

class ShowGenre extends BaseModel
{
    protected $primaryKey = 'showGenreID';

    protected $table = 'show_genre';

    public $timestamps = false;

    protected $fillable = [
        'showID',
        'genreID'
    ];
}

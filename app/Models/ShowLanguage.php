<?php

namespace App\Models;

class ShowLanguage extends BaseModel
{
    protected $primaryKey = 'showLangID';

    protected $table = 'show_language';

    public $timestamps = false;

    protected $fillable = [
        'showID',
        'langID'
    ];
}

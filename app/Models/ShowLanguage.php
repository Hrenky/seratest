<?php

namespace App\Models;

/**
 * Class ShowLanguage
 * @package App\Models
 *
 * @OA\Schema (
 *     schema="ShowLanguageSchema",
 *     title="ShowLanguage",
 *     description="ShowLanguage model",
 *     @OA\Property (
 *         property="showLangaugesID",
 *         description="ID of a showLangauges",
 *         @OA\Schema (type="number", example=1)
 *     ),
 *     @OA\Property (
 *         property="showID",
 *         description="ID of show",
 *         @OA\Schema (type="number", example=1)
 *     ),
 *     @OA\Property (
 *         property="langID",
 *         description="ID of language",
 *         @OA\Schema (type="number", example=1)
 *     ),
 * )
 */
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

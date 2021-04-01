<?php

namespace App\Models;

/**
 * Class Languages
 * @package App\Models
 *
 * @OA\Schema (
 *     schema="LanguageSchema",
 *     title="Languages",
 *     description="Languages model",
 *     @OA\Property (
 *         property="langID",
 *         description="ID of a langauges",
 *         @OA\Schema (type="number", example=1)
 *     ),
 *     @OA\Property (
 *         property="language",
 *         description="Name of language",
 *         @OA\Schema (type="string", example="Croatian")
 *     ),
 * )
 */
class Languages extends BaseModel
{
    protected $primaryKey = 'langID';

    public $timestamps = false;

    protected $fillable = [
        'language'
    ];
}

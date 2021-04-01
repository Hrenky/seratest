<?php

namespace App\Models;

/**
 * Class Genres
 * @package App\Models
 *
 * @OA\Schema (
 *     schema="GenreSchema",
 *     title="Genre",
 *     description="Genre model",
 *     @OA\Property (
 *         property="genreID",
 *         description="ID of a genre",
 *         @OA\Schema (type="number", example=1)
 *     ),
 *     @OA\Property (
 *         property="genre",
 *         description="Name of genre",
 *         @OA\Schema (type="string", example="Action")
 *     ),
 * )
 */
class Genres extends BaseModel
{
    protected $primaryKey = 'genreID';

    public $timestamps = false;

    protected $fillable = [
        'genre'
    ];
}

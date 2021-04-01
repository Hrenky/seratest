<?php

namespace App\Models;

/**
 * Class ShowGenre
 * @package App\Models
 *
 * @OA\Schema (
 *     schema="ShowGenreSchema",
 *     title="ShowGenre",
 *     description="ShowGenre model",
 *     @OA\Property (
 *         property="showGenreID",
 *         description="ID of a showGenre",
 *         @OA\Schema (type="number", example=1)
 *     ),
 *     @OA\Property (
 *         property="showID",
 *         description="ID of show",
 *         @OA\Schema (type="number", example=1)
 *     ),
 *     @OA\Property (
 *         property="genreID",
 *         description="ID of genre",
 *         @OA\Schema (type="number", example=1)
 *     ),
 * )
 */
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

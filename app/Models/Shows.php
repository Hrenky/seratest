<?php

namespace App\Models;

/**
 * Class Shows
 * @package App\Models
 *
 * @OA\Schema (
 *     schema="ShowsSchema",
 *     title="Shows",
 *     description="Shows model",
 *     @OA\Property (
 *         property="showID",
 *         description="ID of a shows",
 *         @OA\Schema (type="number", example=1)
 *     ),
 *     @OA\Property (
 *         property="title",
 *         description="Show title",
 *         @OA\Schema (type="string", example="Blade runner")
 *     ),
 *     @OA\Property (
 *         property="year",
 *         description="Year that show came out",
 *         @OA\Schema (type="number", example=1984)
 *     ),
 *     @OA\Property (
 *         property="rated",
 *         description="Rating of show",
 *         @OA\Schema (type="string", example="R/PG-12")
 *     ),
 *     @OA\Property (
 *         property="release",
 *         description="Exact date when show came out",
 *         @OA\Schema (type="date", example="3rd June 1989")
 *     ),
 *     @OA\Property (
 *         property="length",
 *         description="Runtime of the show",
 *         @OA\Schema (type="number", example=117)
 *     ),
 *     @OA\Property (
 *         property="plot",
 *         description="Full plot of the show",
 *         @OA\Schema (type="string", example="Lots of text about the show")
 *     ),
 *     @OA\Property (
 *         property="poster",
 *         description="Name of the picture in storage",
 *         @OA\Schema (type="string", example="blade-runner.jpg")
 *     ),
 *     @OA\Property (
 *         property="ratings",
 *         description="Set of ratings for the show",
 *         @OA\Schema (type="string", example="[{'source':'value'}]")
 *     ),
 *     @OA\Property (
 *         property="type",
 *         description="Show type",
 *         @OA\Schema (type="string", example="movie/show/episode")
 *     ),
 * )
 */
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

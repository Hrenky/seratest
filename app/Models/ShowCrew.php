<?php

namespace App\Models;

/**
 * Class ShowCrew
 * @package App\Models
 *
 * @OA\Schema (
 *     schema="ShowCrewSchema",
 *     title="ShowCrew",
 *     description="ShowCrew model",
 *     @OA\Property (
 *         property="showCrewID",
 *         description="ID of a showCrew",
 *         @OA\Schema (type="number", example=1)
 *     ),
 *     @OA\Property (
 *         property="showID",
 *         description="ID of show",
 *         @OA\Schema (type="number", example=1)
 *     ),
 *     @OA\Property (
 *         property="crewID",
 *         description="ID of crew",
 *         @OA\Schema (type="number", example=1)
 *     ),
 * )
 */
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

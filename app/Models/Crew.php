<?php

namespace App\Models;

/**
 * Class Crew
 * @package App\Models
 *
 * @OA\Schema (
 *     schema="CrewSchema",
 *     title="Crew",
 *     description="Crew model",
 *     @OA\Property (
 *         property="crewID",
 *         description="ID of a crew member",
 *         @OA\Schema (type="number", example=1)
 *     ),
 *     @OA\Property (
 *         property="name",
 *         description="Name of a crew member",
 *         @OA\Schema (type="string", example="Quentin Tarantino")
 *     ),
 *     @OA\Property (
 *         property="type",
 *         description="Crew member type",
 *         @OA\Schema (type="string", example="Director/Writer/Actor")
 *     ),
 * )
 */
class Crew extends BaseModel
{
    const DIRECTOR = 1;
    const WRITER = 2;
    const ACTOR = 3;

    protected $primaryKey = 'crewID';

    protected $table = 'crew';

    protected $fillable = [
        'name',
        'type'
    ];
}

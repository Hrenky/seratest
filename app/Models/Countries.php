<?php

namespace App\Models;

/**
 * Class Countries
 * @package App\Models
 *
 * @OA\Schema (
 *     schema="CountriesSchema",
 *     title="Countries",
 *     description="Countries model",
 *     @OA\Property (
 *         property="countryID",
 *         description="ID of a country",
 *         @OA\Schema (type="number", example=1)
 *     ),
 *     @OA\Property (
 *         property="country",
 *         description="Name of a country",
 *         @OA\Schema (type="string", example="USA")
 *     ),
 * )
 */
class Countries extends BaseModel
{
    protected $primaryKey = 'countryID';

    public $timestamps = false;

    protected $fillable = [
        'country'
    ];
}

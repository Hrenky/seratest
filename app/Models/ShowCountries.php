<?php

namespace App\Models;

/**
 * Class ShowCountries
 * @package App\Models
 *
 * @OA\Schema (
 *     schema="ShowCountriesSchema",
 *     title="ShowCountries",
 *     description="ShowCountries model",
 *     @OA\Property (
 *         property="showCountryID",
 *         description="ID of a langauges",
 *         @OA\Schema (type="number", example=1)
 *     ),
 *     @OA\Property (
 *         property="showID",
 *         description="ID of show",
 *         @OA\Schema (type="number", example=1)
 *     ),
 *     @OA\Property (
 *         property="countryID",
 *         description="ID of country",
 *         @OA\Schema (type="number", example=1)
 *     ),
 * )
 */
class ShowCountries extends BaseModel
{
    protected $primaryKey = 'showCountryID';

    public $timestamps = false;

    protected $fillable = [
        'showID',
        'countryID'
    ];
}

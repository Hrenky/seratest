<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Laravel\Lumen\Routing\Controller as MainController;

/**
 * @OA\Info(
 *     title="Seratest app for getting movies",
 *     version="1.0.0",
 *     @OA\Contact(
 *          email="ivan.hrenovac@gmail.com",
 *          name="Ivan hrenovac"
 *     )
 * )
 */
class BaseController extends MainController
{
    /* @var Users $user */
    protected $user;

    public function __construct() {
        if(preg_match('/register/', $_SERVER['REQUEST_URI'])){
            return true;
        }

        $this->user = Users::find(auth()->user()->getAuthIdentifier());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Laravel\Lumen\Routing\Controller as MainController;

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

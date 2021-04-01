<?php

namespace App\Http\Controllers;

use App\Models\Sessions;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Closure;
use Laravel\Lumen\Routing\Router;

class LoginController extends BaseController
{
    public function __construct(){}

    /**
     * @OA\Get (
     *     path="/",
     *     summary="Login screen",
     *     description="Login screen",
     *     @OA\Response (
     *          response=200,
     *          description="Show screen for loging in",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Login screen opened")
     *              )
     *          )
     *     )
     *     @OA\Response (
     *          response=302,
     *          description="If already logged in, redirect to shows",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Redirecting ")
     *              )
     *          )
     *     )
     * )
     */
    public function loginScreen() {
        if(auth()->check()){
            return redirect()->to('show');
        }

        return view('login');
    }

    /**
     * @OA\Post (
     *     path="/",
     *     summary="Login screen",
     *     description="Login screen",
     *     @OA\RequestBody (
     *          required=true,
     *          description="Deliver user information",
     *          @OA\JsonContent (
     *              required={"username", "password"},
     *              @OA\Property(property="username", type="string", example="Test"),
     *              @OA\Property(property="password", type="string", format="password", example="PassWord12345")
     *          )
     *     ),
     *     @OA\Response (
     *          response=302,
     *          description="If credentials are good, redirect to show page",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Redirecting to show")
     *              )
     *          )
     *     )
     * )
     */
    public function login(){
        $credentials = request(['username', 'password']);
        $rememberMe = (bool) request(['remember']);

        if(auth()->check()){
            return redirect()->to('show');
        }

        if(!$token = auth()->attempt($credentials)){
            return view('unauthorized', ['text' => 'Seems that something wrong was entered. Tough luck old chap.']);
        }

        $user = auth()->user();

        $session = Sessions::firstOrNew([
            'userID' => $user->getAuthIdentifier(),
            'agent' => $_SERVER['HTTP_USER_AGENT'],
        ], [
            'userID' => $user->getAuthIdentifier(),
            'agent' => $_SERVER['HTTP_USER_AGENT'],
            'token' => $token,
            'expire' => date('Y-m-d H:i:s',time() + 86400)
        ]);

        if($rememberMe){
            $session->expire = date('Y-m-d H:i:s',time() + 86400 * 60);
        }
        $session->save();

        setcookie('Authorization', 'Bearer '.$token, time() + 86400, '/');

        return redirect()->to('show');
    }

    /**
     * @OA\Get (
     *     path="/logout",
     *     summary="Logout function",
     *     description="Logout function",
     *     @OA\Response (
     *          response=302,
     *          description="Logs you out if logged in",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Redirecting to login screen")
     *              )
     *          )
     *     )
     * )
     */
    public function logout(){
        $token = request()->bearerToken();

        $session = Sessions::where(['token' => $token])->firstOrFail();

        $session->expire = date('Y-m-d H:i:s', time() - 3600);
        $session->save();

        auth()->logout();

        setcookie('Authorization', '', time() - 3600, '/');

        return redirect()->to('/');
    }
}

<?php

namespace App\Http\Middleware;

use App\Models\Sessions;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\JWT;

class Authenticate
{
    /**
     * The authentication guard factory instance.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth, JWT $jwt)
    {
        /*dump(\Illuminate\Support\Facades\Cookie::has('Authorization'));
        dump(Cookie::get('Authorization'));
        exit;
        dump($_COOKIE);
        exit;

        $this->auth = $auth;
        $this->jwt = $jwt;*/
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->bearerToken();

        if(empty($token)){
            return view('login', ['text' => 'Your time is up.']);
        }

        if(!auth()->check()){
            $session = Sessions::where('token', $token)->first();

            if(!isset($session)){
                return view('unauthorized', ['text' => 'This part of the site is above your clearance!']);
            }

            if($session->expire < date('Y-m-d H:i:s')){
                return view('unauthorized', ['text' => 'This part of the site is above your clearance!']);
            }

            $newToken = auth()->refresh(true, true);
            auth()->setToken($newToken);

            $session->token = $newToken;
            $session->save();

            setcookie('Authorization', 'Bearer '.$newToken, time() + 86400, '/');
        }

        return $next($request);
    }
}

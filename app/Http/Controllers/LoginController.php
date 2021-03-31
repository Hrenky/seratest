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
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Laravel\Lumen\Application|\Laravel\Lumen\Http\Redirector
     */
    public function loginScreen() {
        if(auth()->check()){
            return redirect()->to('show');
        }

        return view('login');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View|\Laravel\Lumen\Application|\Laravel\Lumen\Http\Redirector
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

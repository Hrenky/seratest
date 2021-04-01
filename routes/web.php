<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', 'LoginController@loginScreen');

$router->get('posters/{image}', function ($image) {
    return Storage::disk('posters')->get($image);
});

$router->group(['middleware' => 'auth'], function () use ($router){
    $router->get('show', function () {
        return view('show-search');
    });

    $router->get('logout', 'LoginController@logout');
});

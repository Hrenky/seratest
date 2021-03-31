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

$router->post('register', 'AccountController@register');

$router->post('login', 'LoginController@login');

$router->group(['middleware' => 'auth'], function () use ($router){
    $router->post('show/local', 'ShowController@getAllShowLocal');
    $router->post('show/single', 'ShowController@getShowLocal');
    $router->post('show/online', 'ShowController@getShowOnline');
});

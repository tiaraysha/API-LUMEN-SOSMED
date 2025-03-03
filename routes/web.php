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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/login', 'UserController@login');
$router->get('/logout', 'UserController@logout');

$router->group(['middleware' => 'auth'], function () use ($router) {

    $router->group(['prefix' => 'posts'], function() use($router) {
        $router->post('/', 'PostController@store');
        $router->get('/show', 'PostController@index');
        $router->get('/{id}', 'PostController@show');
    $router->patch('/{id}', 'PostController@update');
    $router->delete('/{id}', 'PostController@delete');
    });

    $router->group(['prefix' => 'comments'], function() use($router) {
        $router->post('/', 'CommentController@store');
        $router->get('/show', 'CommentController@index');
        $router->patch('/{id}', 'CommentController@update');
        $router->delete('/{id}', 'CommentController@delete');
    });

    $router->group(['prefix' => 'likes'], function() use($router) {
        $router->post('/{postId}', 'LikeController@likeUnlike');
    });

    $router->group(['prefix' => 'follows'], function() use($router) {
        $router->post('/{id}', 'FollowController@followUnfollow');
    });

    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->post('/', 'UserController@store');
        $router->get('/show', 'UserController@index');
        $router->get('/{id}', 'UserController@show');
        $router->patch('/{id}', 'UserController@update');
        $router->delete('/{id}', 'UserController@delete');
        
    });
});

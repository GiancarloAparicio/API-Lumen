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

$router->post('api/v1/login', [
    'uses' => 'AuthController@login',
    'as' => 'login'
]);

$router->post('api/v1/register', [
    'uses' => 'AuthController@register',
    'as' => 'register'
]);


//Version: 1.0.0   --   Path: api/v1/...
$router->group(['prefix' => 'api/v1', 'middleware' => 'auth'], function () use ($router) {

    //Controller: auth
    $router->post('/logout', [
        'uses' => 'AuthController@logout',
        'as' => 'logout'
    ]);

    //Controller: task
    $router->group(['prefix' => 'task'], function () use ($router) {

        $router->get('/', [
            'uses' => 'TaskController@index',
            'as' => 'task.index'
        ]);

        $router->post('/', [
            'uses' => 'TaskController@store',
            'as' => 'task.store'
        ]);

        $router->get('/{id}', [
            'uses' => 'TaskController@show',
            'as' => 'task.show'
        ]);

        $router->put('/{id}', [
            'uses' => 'TaskController@update',
            'as' => 'task.update'
        ]);

        $router->delete('/{id}', [
            'uses' => 'TaskController@destroy',
            'as' => 'task.destroy'
        ]);
    });
});

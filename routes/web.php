<?php

use App\Models\Cars\Cars;
use App\Models\User\User;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/* ROTAS DOS USUÁRIOS
****************************************************************************************/
$router->group(['prefix' => 'api/v1', 'namespace' => 'V1\User', 'as' => User::class], function () use ($router) {
    $router->post('/usuarios',        ['uses' => 'UserController@create', 'middleware' => 'ValidateDataMiddleware']);
    $router->get('/usuarios',         ['uses' => 'UserController@findAll']);
    $router->get('/usuarios/{id}',    ['uses' => 'UserController@findOneBy']);
    $router->put('/usuarios/{id}',    ['uses' => 'UserController@editBy', 'middleware' => 'ValidateDataMiddleware']);
    $router->delete('/usuarios/{id}', ['uses' => 'UserController@delete']);
});

/* ROTAS DOS CARROS
****************************************************************************************/
$router->group(['prefix' => 'api/v1', 'namespace' => 'V1\Cars', 'as' => Cars::class], function () use ($router) {
    $router->post('/carros',                ['uses' => 'CarsController@create', 'middleware' => 'ValidateDataMiddleware']);
    $router->get('/carros',                 ['uses' => 'CarsController@findAll']);
    $router->get('/carros/{id}',            ['uses' => 'CarsController@findOneBy']);
    $router->get('/carros/usuarios/{user}', ['uses' => 'CarsController@findByUser']);
    $router->put('/carros/{id}',            ['uses' => 'CarsController@editBy', 'middleware' => 'ValidateDataMiddleware']);
    $router->delete('/carros/{id}',         ['uses' => 'CarsController@delete']);
});

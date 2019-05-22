<?php

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

$router->get('', function () use ($router) {
    return $router->app->version();
});

//generate app key
$router->get('/key', 'MyTaskController@generateKey');

$router->group(['prefix'=>'api/user'], function() use ($router){
    $router->get('{username}/profile', ['uses' => 'UserController@getProfile']);
    $router->post('', ['uses' => 'UserController@addUser']);
    $router->put('',['uses' => 'UserController@editProfile']);
});

$router->group(['prefix'=>'api/task'],function() use ($router){
    $router->get('list', ['uses' => 'MyTaskController@getListTask']);
    $router->get('{id}', ['uses' => 'MyTaskController@getDetailtask']);
    $router->post('',['uses' => 'MyTaskController@addTask']);
    $router->put('{id}/done', ['uses' => "MyTaskController@completeTask"]);
    $router->put('{id}/undone', ['uses'=>"MyTaskController@uncompleteTask"]);
    $router->delete('{id}', ['uses' => "MyTaskController@deleteTask"]);
});

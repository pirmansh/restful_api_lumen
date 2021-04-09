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

// Route Employees
$router->group(['prefix' => 'api/v1/employees'], function () use ($router) {
    $router->get('/', 'EmployeeController@getAll');
    $router->get('/{id}', 'EmployeeController@getById');
    $router->post('/', 'EmployeeController@insert');
    $router->put('/{id}', 'EmployeeController@update');
    $router->delete('/{id}', 'EmployeeController@delete');
});

// Route Products
$router->group(['prefix' => 'api/v1/products'], function () use ($router) {
    $router->get('/', 'ProductController@getAll');
    $router->get('/{id}', 'ProductController@getById');
    $router->post('/', 'ProductController@insert');
    $router->put('/{id}', 'ProductController@update');
    $router->delete('/{id}', 'ProductController@delete');
});

// Route Categories
$router->group(['prefix' => 'api/v1/categories'], function () use ($router) {
    $router->get('/', 'CategoryController@getAll');
    $router->get('/{id}', 'CategoryController@getById');
    $router->post('/', 'CategoryController@insert');
    $router->put('/{id}', 'CategoryController@update');
    $router->delete('/{id}', 'CategoryController@delete');
});

// Route Suppliers
$router->group(['prefix' => 'api/v1/suppliers'], function () use ($router) {
    $router->get('/', 'SupplierController@getAll');
    $router->get('/{id}', 'SupplierController@getById');
    $router->post('/', 'SupplierController@insert');
    $router->put('/{id}', 'SupplierController@update');
    $router->delete('/{id}', 'SupplierController@delete');
});

// Route Orders
$router->group(['prefix' => 'api/v1/orders'], function () use ($router) {
    $router->get('/', 'OrderController@getAll');
    $router->get('/{id}', 'OrderController@getById');
    $router->post('/', 'OrderController@insert');
    $router->put('/{id}', 'OrderController@update');
    $router->delete('/{id}', 'OrderController@delete');
});
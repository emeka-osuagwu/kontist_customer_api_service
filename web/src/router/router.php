<?php
/**
* This file contains all the routes for the project
*/

use Emeka\Router\RouterConfig as Router;
use Emeka\Middlewares\CsrfVerifier;
use Emeka\Middlewares\ApiVerification;
use Emeka\Http\Handlers\CustomExceptionHandler;

Router::csrfVerifier(new CsrfVerifier());

Router::group(['namespace' => '\Emeka\Http\Controllers', 'exceptionHandler' => CustomExceptionHandler::class], function () {

	Router::get('/', 'CustomerController@index');

	// API Routes
	Router::group(['prefix' => '/api', 'middleware' => ApiVerification::class], function () {
		Router::post('/login', 'AuthController@login');
		Router::get('/', 'CustomerController@customers');
		Router::get('/customer/{id}', 'CustomerController@customer');
		Router::post('/customer', 'CustomerController@create');
		Router::post('/customer/{id}', 'CustomerController@update');
		Router::delete('/customer/{id}', 'CustomerController@delete');
	});
});
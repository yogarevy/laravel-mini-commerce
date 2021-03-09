<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// REGISTER
Route::group(['as' => 'api::', 'namespace' => 'Api', 'prefix' => 'v1'], function () {
    Route::group(['as' => 'register.', 'prefix' => 'register'], function () {
        Route::post('/', ['as' => 'create', 'uses' => 'RegisterController@create']);
    });
});

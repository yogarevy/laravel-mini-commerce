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

// CATEGORY
Route::group(['as' => 'api::', 'namespace' => 'Api', 'prefix' => 'v1', 'middleware' => ['auth:api']], function () {
    Route::group(['as' => 'category.', 'prefix' => 'category', 'middleware' => ['access']], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'CategoryController@index']);
        Route::post('/create', ['as' => 'create', 'uses' => 'CategoryController@create']);
        Route::post('/update/{id}', ['as' => 'update', 'uses' => 'CategoryController@update']);
        Route::get('/show/{id}', ['as' => 'show', 'uses' => 'CategoryController@show']);
        Route::delete('/delete/{id}', ['as' => 'delete', 'uses' => 'CategoryController@destroy']);
    });
});

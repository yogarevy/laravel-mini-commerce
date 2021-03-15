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
        Route::post('/create', ['as' => 'post.create', 'uses' => 'CategoryController@create']);
        Route::post('/update/{id}', ['as' => 'post.update', 'uses' => 'CategoryController@update']);
    });
});

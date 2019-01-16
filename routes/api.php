<?php

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

Route::group(['namespace' => 'Back', 'prefix' => 'back'], function () {
    Route::post('/login', 'LoginController@loginAdmin');
    Route::group(['middleware' => 'token'], function () {
        Route::resource('/article', 'ArticleController', ['only' => ['index', 'show', 'destroy', 'update', 'store']]);
        Route::resource('/tag', 'TagController', ['only' => ['index', 'show', 'destroy', 'update', 'store']]);
        Route::resource('/setting/links', 'LinksController', ['only' => ['index', 'show', 'destroy', 'update', 'store']]);
        Route::post('/sign', 'TenCentCosController@sign');
    });
});

Route::group(['namespace' => 'Home\Api'], function () {
    Route::resource('/article', 'ArticleController', ['only' => ['index', 'show']]);
    Route::get('/category/{id}','ArticleController@category');
    Route::delete('/article', 'ArticleController@delete');
    Route::post('/tags', 'IndexController@getTags');
});


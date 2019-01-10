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

Route::group(['namespace'=>'Back','prefix'=>'back'],function(){
    Route::resource('/article', 'ArticleController',['only' => ['index', 'show','destroy']]);
    Route::resource('/tag', 'TagController',['only' => ['index', 'show','destroy']]);

});

Route::group(['namespace' => 'Home\Api'], function () {
    Route::resource('/article', 'ArticleController',['only' => ['index', 'show']]);
    Route::delete('/article','ArticleController@delete');
    Route::post('/setting','IndexController@setting');
    Route::post('/sign','TenCentCosController@sign');
});


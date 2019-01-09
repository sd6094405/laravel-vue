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
    Route::get('/article','ArticleController@getLists');
    Route::post('/article/create','ArticleController@create');
});

Route::group(['namespace' => 'Home\Api'], function () {
    Route::resource('/article', 'ArticleController',['only' => ['index', 'show']]);
    Route::post('/setting','IndexController@setting');
    Route::post('/sign','TenCentCosController@sign');
    Route::put('/test','TenCentCosController@test');
});


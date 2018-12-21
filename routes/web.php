<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::group(['namespace' => 'Home'], function () {
    Route::get('/', 'IndexController@index');
    Route::get('/index', 'IndexController@index');
    Route::resource('/article', 'ArticleController',['only' => ['index', 'show']]);

});

Route::group(['namespace'=>'Back','prefix'=>'back'],function(){
    Route::get('/','IndexController@index');
    Route::get('/article','IndexController@index');
    Route::get('/article/create','IndexController@index');
//    Route::get('/article/create','IndexController@index');
});
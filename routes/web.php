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
    Route::get('/', 'IndexController@view');
    Route::get('/index', 'IndexController@view');
    Route::resource('/article', 'ArticleController', ['only' => ['index', 'show']]);

});

Route::group(['namespace' => 'Back', 'prefix' => 'back'], function () {
    Route::get('/', 'IndexController@view');
    Route::match(['post', 'get'], '{all}', 'IndexController@view')->where(['all' => '.*']);
});
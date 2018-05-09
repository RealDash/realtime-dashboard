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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/generic/{wildcard}', function($wildcard){
    return view('template.'.$wildcard);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'tasks'], function() {
    Route::get('/', 'TaskController@index')->name('tasks');
    Route::get('/create', 'TaskController@create')->name('create-task');
});

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

Route::group(['prefix' => 'tasks', 'middleware' => ['auth']], function() {
    Route::get('/', 'TaskController@index')->name('tasks');
    Route::get('/pending', 'TaskController@pending')->name('tasks.pending');
    Route::get('/completed', 'TaskController@completed')->name('tasks.completed');
    Route::get('/create', 'TaskController@create')->name('create-task');
    
    Route::get('/edit/{task}', 'TaskController@edit')->name('edit-task');
    Route::get('/show/{task}', 'TaskController@show')->name('show-task');
});

Route::group(['prefix' => 'categories'], function() {

});

Route::group(['prefix' => 'admin'], function() {
    Route::post('/task/create', 'Admin\TaskController@store')->name('new-task');
    Route::get('/manage/users', 'Admin\UserController@viewUsers')->name('admin.user');
    Route::get('/manage/tasks', 'Admin\TaskController@viewTasks')->name('admin.task');
    Route::get('/manage/task/{id}', 'Admin\TaskController@viewSingleTask')->name('admin.task.single');
});


Route::get('/dashboard', 'UserController@dashboard');
Route::get('/profile', 'UserController@profile');
// Route::get('/create', 'TaskController@create');
// Route::post('/create', 'TaskController@store');
// Route::get('/edit/{task}', 'TaskController@edit');
// Route::get('/show/{task}', 'TaskController@show');

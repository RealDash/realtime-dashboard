<?php
use App\Events\TaskUpdate;
use Auth;
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
    
    return view('proper');
});

Route::get('/proper', function () {
    
    return view('proper');
});

Route::get('/emit', function () {

    event(new TaskUpdate(Auth::user()->user_name, "I just tested pusher now"));
    // return true;
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
    Route::post('/pick', 'TaskController@pickTask')->name('pick-task');
    Route::get('/edit/{task}', 'TaskController@edit')->name('edit-task');
    Route::get('/show/{task}', 'TaskController@show')->name('show-task');
});

Route::group(['prefix' => 'categories'], function() {

});

Route::group(['prefix' => 'admin','middleware' => ['admin']], function() {
    Route::post('/task/create', 'Admin\TaskController@store')->name('new-task');
    Route::get('/manage/users', 'Admin\UserController@viewUsers')->name('admin.user');
    Route::get('/manage/tasks', 'Admin\TaskController@viewTasks')->name('admin.task');
    Route::get('/manage/categories', 'Admin\CategoryController@viewCategories')->name('admin.category');
    Route::post('/manage/category/create', 'Admin\CategoryController@create')->name('admin.category.create');
    Route::get('/manage/task/{id}', 'Admin\TaskController@viewSingleTask')->name('admin.task.single');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', 'UserController@dashboard');
    Route::post('/avatar/upload', 'UserController@changeAvatar');
    Route::post('/changepassword', 'UserController@changePassword')->name('changepassword');
    Route::get('/profile', 'UserController@profile');
});

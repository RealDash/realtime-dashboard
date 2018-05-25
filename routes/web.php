<?php
use App\Events\TaskUpdate;

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

Route::get('/payment', 'PaymentController@paymentForm');

Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');
Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay'); 


Route::get('/','HomeController@index');

Route::get('/emit', function () {
    return phpinfo();
    // event(new TaskUpdate(Auth::user()->user_name, "I just tested pusher now"));
    // return true;
});

Route::get('/generic/{wildcard}', function($wildcard){
    return view('template.'.$wildcard);
});

Route::group(['prefix' => 'api/v1'], function() {
    Route::get('/date', function(){
        return date('Y-m-d H:i:s');
    })->name('date');
    Route::get('/log/{id}', 'TaskLogController@getLog')->name('tasks.log');
    Route::get('/events', 'EventController@getEvents')->name('api.event');
    Route::get('/musics', 'MusicController@apiGetMusics')->name('api.music');
    Route::get('/scrums', 'TaskController@apiGetScrums')->name('api.scrum');
    Route::get('/gists', 'GistController@apiGetGists')->name('api.gist');
    Route::get('/announcements', 'AnnouncementController@apiGetAnnouncements')->name('api.announcements');
    Route::get('/music/setcurrent/{id}', 'MusicController@apiSetCurrentMusic')->name('api.music.set.current');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'tasks', 'middleware' => ['auth']], function() {
    Route::get('/', 'TaskController@index')->name('tasks');
    Route::get('/pending', 'TaskController@pending')->name('tasks.pending');
    Route::get('/completed', 'TaskController@completed')->name('tasks.completed');
    Route::post('/markascompleted', 'TaskController@markAsCompleted')->name('task.markas.completed');
    Route::get('/create', 'TaskController@create')->name('create-task');
    Route::post('/pick', 'TaskController@pickTask')->name('pick-task');
    Route::get('/edit/{task}', 'TaskController@edit')->name('edit-task');
    Route::get('/show/{task}', 'TaskController@show')->name('show-task');
});

Route::group(['prefix' => 'categories'], function() {

});


Route::group(['prefix' => 'admin','middleware' => ['admin']], function() {

    Route::post('/manage/music/delete/{id}', 'Admin\MusicController@deleteSingleMusic');

    Route::get('/manage/users', 'Admin\UserController@viewUsers')->name('admin.user');
    Route::post('/manage/user/create', 'Admin\UserController@register')->name('admin.user.create');
    Route::post('/manage/user/delete/{id}', 'Admin\UserController@deleteSingleUser')->name('admin.user.delete');

    Route::post('/task/create', 'Admin\TaskController@store')->name('new-task');
    Route::get('/manage/tasks', 'Admin\TaskController@viewTasks')->name('admin.task');
    Route::get('/manage/events', 'Admin\EventController@viewEvents')->name('admin.event');
    Route::post('/manage/event/create', 'Admin\EventController@createEvent')->name('admin.event.create');
    Route::post('/manage/event/delete/{event_id}', 'Admin\EventController@deleteEvent')->name('admin.event.delete');

    Route::get('/manage/categories', 'Admin\CategoryController@viewCategories')->name('admin.category');
    Route::post('/manage/category/create', 'Admin\CategoryController@create')->name('admin.category.create');
    Route::get('/manage/task/{id}', 'Admin\TaskController@viewSingleTask')->name('admin.task.single');

    //Admin Music Routes
    Route::get('/manage/musics', 'Admin\MusicController@getMusics');
    Route::post('/manage/music/upload', 'Admin\MusicController@uploadMusic');
    Route::get('/manage/musics/count', 'MusicController@getMusicsCount');
    Route::get('/manage/music/{id}', 'Admin\MusicController@getSingleMusicDetails');
    Route::post('/manage/music/create', 'Admin\MusicController@createMusic')->name('music.create');
    Route::patch('/manage/music/edit/{id}', 'Admin\MusicController@editSingleMusic');
    Route::post('/manage/music/delete/{id}', 'Admin\MusicController@deleteSingleMusic');
    Route::delete('/manage/music/delete/multiple/selected', 'Admin\MusicController@deleteMultipleMusic');

     //Admin Artist Routes
     Route::get('/manage/artists', 'Admin\ArtistController@getArtists');
     Route::get('/manage/artist/{id}', 'Admin\ArtistController@getSingleArtistDetails');
     Route::get('/manage/artists/count', 'Admin\ArtistController@getArtistsCount');
     Route::patch('/manage/artist/edit/{id}', 'Admin\ArtistController@editSingleArtist');
     Route::post('/manage/artist/create', 'Admin\ArtistController@createArtist')->name('admin.artist.create');
     Route::delete('/manage/artist/delete/{id}', 'Admin\ArtistController@deleteSingleArtist');
     Route::delete('/manage/artist/delete/multiple/selected', 'Admin\ArtistController@deleteMultipleArtist');

     Route::get('/manage/announcements', 'Admin\AnnouncementController@index')->name('announcements');
     Route::post('/manage/announcement/new', 'Admin\AnnouncementController@store')->name('new.announcement');
     Route::get('/manage/announcement/{id}', 'Admin\AnnouncementController@show')->name('announcement');


});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', 'UserController@dashboard');
    Route::post('/avatar/upload', 'UserController@changeAvatar');
    Route::post('/profile/socials/update', 'UserController@updateSocials')->name('user.profile.socials.update');
    Route::post('/changepassword', 'UserController@changePassword')->name('changepassword');
    Route::get('/profile', 'UserController@profile');
    Route::get('/gists', 'UserController@gists');
    Route::post('/gist/create', 'GistController@store')->name('new-gist');
    Route::get('view/gist/{id}', 'GistController@show')->name('view.single.gist');

});

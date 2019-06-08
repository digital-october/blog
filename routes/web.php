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

Auth::routes();

Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser')->name('user.verify');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('locale/{locale}', function ($locale) {
    $locale = 'ru';
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::group(['middleware' => 'auth'], function () {

//    Route::get('/users', 'UserController@index')->name('users.index');
    Route::resource('users', 'UserController');
    Route::group(['prefix' => 'user'], function () {
        Route::get('/{user}/profile', 'UserController@show')->name('user.profile');
        Route::get('make/admin/{user}', 'UserController@makeAdmin')->name('user.make.admin');
        Route::get('dismiss/{user}', 'UserController@dismiss')->name('user.dismiss');
        Route::get('delete/{user}', 'UserController@destroy')->name('user.delete');
    });

    Route::get('moderation', 'ModerationController@index')->name('moderation');
    Route::get('moderation/accepted/{post}', 'ModerationController@accepted')->name('moderation.accepted');
    Route::post('moderation/rework/{post}', 'ModerationController@rework')->name('moderation.rework');
    Route::post('moderation/reject/{post}', 'ModerationController@reject')->name('moderation.reject');

    Route::resource('magazines', 'MagazineController');

    Route::resource('posts', 'PostController');
    Route::group(['as' => 'posts.', 'prefix' => 'posts'], function () {
        Route::post('search', 'PostController@index')->name('search');
        Route::get('{post}/download', 'PostController@download')->name('download');
        Route::get('/user/{user}', 'PostController@userIndex')->name('user');
        Route::get('/category/{category}', 'PostController@categoryIndex')->name('category');
        Route::post('{post}/user/{user}/commented', 'CommentController@store')->name('comment.create');
        Route::delete('/comment/{comment}/delete', 'CommentController@destroy')->name('comment.delete');
    });
});


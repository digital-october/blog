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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('locale/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/users', 'UserController@index')->name('users.index');
    Route::group(['prefix' => 'user'], function () {
        Route::get('make/admin/{user}', 'UserController@makeAdmin')->name('user.make.admin');
        Route::get('dismiss/{user}', 'UserController@dismiss')->name('user.dismiss');
        Route::get('delete/{user}', 'UserController@destroy')->name('user.delete');
    });

    Route::resource('posts', 'PostController');
    Route::group(['as' => 'posts.', 'prefix' => 'posts'], function () {
        Route::post('{post}/user/{user}/commented', 'CommentController@store')->name('comment.create');
        Route::delete('/comment/{comment}/delete', 'CommentController@destroy')->name('comment.delete');
    });
});


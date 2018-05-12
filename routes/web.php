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

Route::group(
    [
        'middleware' => 'auth',
    ], function () {

        # Users
        Route::get('/users', 'UserController@show')->name('users.show');

        Route::group(['prefix' => 'user'], function () {
            Route::get('make/admin/{user}', 'UserController@makeAdmin')->name('user.make.admin');
            Route::get('dismiss/{user}', 'UserController@dismiss')->name('user.dismiss');
            Route::get('delete/{user}', 'UserController@destroy')->name('user.delete');
        });

        # Posts
        Route::get('/posts', 'PostController@index')->name('posts');

        Route::group(['prefix' => 'post'], function () {
            Route::get('/create', 'PostController@create')->name('post.create');
            Route::get('/show/{post}', 'PostController@show')->name('post.show');
            Route::get('/edit/{id}', 'PostController@edit')->name('post.edit');
            Route::post('/edit/{id}', 'PostController@update')->name('post.update');
            Route::get('/delete/{id}', 'PostController@destroy')->name('post.delete');
            Route::post('/create/{user}', 'PostController@store')->name('post.store');
            Route::post('/create/{post}/{user}', 'PostController@createComment')->name('comment.create');
            Route::get('/comment/delete/{comment}', 'PostController@destroyComment')->name('comment.delete');
        });
    }
);


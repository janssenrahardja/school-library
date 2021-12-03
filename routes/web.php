<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function(){
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    //users
    Route::group(['prefix' => 'users', 'middleware' => ['admin']], function(){
        Route::get('/','UserController@index')->name('users');
        Route::get('create','UserController@create')->name('users.create');
        Route::post('/','UserController@store')->name('users.store');
        Route::get('{id}','UserController@show')->name('users.detail');
        Route::get('delete/{id}','UserController@delete')->name('users.delete');
    });
    Route::post('users/{id}','UserController@update')->name('users.update');

    Route::get('profile','UserController@profile')->name('profile');

    //authors
    Route::group(['prefix' => 'authors'], function(){
        Route::get('/','AuthorController@index')->name('authors');
        Route::get('create','AuthorController@create')->name('authors.create');
        Route::post('/','AuthorController@store')->name('authors.store');
        Route::get('{id}','AuthorController@show')->name('authors.detail');
        Route::post('{id}','AuthorController@update')->name('authors.update');
        Route::get('delete/{id}','AuthorController@delete')->name('authors.delete');
    });

    //books
    Route::group(['prefix' => 'books'], function(){
        Route::get('/','BookController@index')->name('books');
        Route::get('create','BookController@create')->name('books.create');
        Route::post('/','BookController@store')->name('books.store');
        Route::get('{id}','BookController@show')->name('books.detail');
        Route::post('{id}','BookController@update')->name('books.update');
        Route::get('delete/{id}','BookController@delete')->name('books.delete');
    });
});

require __DIR__.'/auth.php';

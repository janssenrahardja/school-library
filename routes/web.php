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

    Route::group(['prefix' => 'users', 'middleware' => ['admin']], function(){
        Route::get('/','UserController@index')->name('users');
        Route::get('create','UserController@create')->name('users.create');
        Route::post('/','UserController@store')->name('users.store');
        Route::get('{id}','UserController@show')->name('users.detail');
        Route::get('delete/{id}','UserController@delete')->name('users.delete');
    });
    Route::post('users/{id}','UserController@update')->name('users.update');

    Route::get('profile','UserController@profile')->name('profile');
});

require __DIR__.'/auth.php';

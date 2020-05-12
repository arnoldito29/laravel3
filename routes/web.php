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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->group(function () {
    Route::prefix('/debts')->name('debts.')->group(function () {
        Route::get('/', 'DebtController@index')->name('index');
        Route::post('/', 'DebtController@store')->name('store');
        Route::get('/create', 'DebtController@create')->name('create');
        Route::get('/{debt}', 'DebtController@edit')->name('edit');
        Route::patch('/{debt}', 'DebtController@update')->name('update');
        Route::delete('/{debt}', 'DebtController@destroy')->name('destroy');
    });

    Route::prefix('/users')->name('users.')->group(function () {
        Route::get('/profile', 'UserController@profile')->name('profile');
        Route::post('/', 'UserController@update')->name('update');
    });
});
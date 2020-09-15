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
Route::get('/', 'HomeController@index')->name('pagina-inicial');

//Login e Registro User
Route::group(['prefix' => 'user'], function () {
    Route::get('/login', 'UserAuthControllers\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'UserAuthControllers\LoginController@login');
    Route::get('/logout', 'UserAuthControllers\LoginController@logout')->name('logout');

    Route::get('/register', 'UserAuthControllers\RegisterController@showRegistrationForm')->name('registerUser');
    Route::post('/register', 'UserAuthControllers\RegisterController@create')->name('user.register');
  });



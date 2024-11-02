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

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Route::get('register', 'UserController@register')->name('user.register');
Route::post('register', 'UserController@store')->name('user.store');
Route::get('login', 'UserController@login')->name('user.login');
Route::post('login', 'UserController@checkLogin')->name('user.checkLogin');
Route::get('logout', 'UserController@logout')->name('user.logout');


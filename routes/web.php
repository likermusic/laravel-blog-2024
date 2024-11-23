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

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');

//по умолч редиректит на /login но тк этот путь имеет псевдоним то нужно идти в mdlwr app/Http/Middleware/Authenticate.php и изм метод redirectTo() на псевдоним, а то не будет работать
// Route::post('/', 'HomeController@store')->name('post.store')->middleware('auth');
Route::post('/', 'HomeController@store')->name('post.store');
Route::delete('/', 'HomeController@delete')->name('post.delete');


Route::middleware('guest')->group(function() {
  Route::get('register', 'UserController@register')->name('user.register');
  Route::get('login', 'UserController@login')->name('user.login');
  Route::post('register', 'UserController@store')->name('user.store');
  Route::post('login', 'UserController@checkLogin')->name('user.checkLogin');
});


// Route::group(['middleware' => 'guest'], function() {
// Route::get('register', 'UserController@register')->name('user.register');
// Route::get('login', 'UserController@login')->name('user.login');
// } 
// );
// Route::get('login', 'UserController@login')->name('user.login')->middleware('guest');
// Route::get('register', 'UserController@register')->name('user.register')->middleware('guest');
Route::get('logout', 'UserController@logout')->name('user.logout');


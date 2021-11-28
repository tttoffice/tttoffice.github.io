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
/*
Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'HomeController@index')->name('index');

Route::get('/home', 'HomeController@index')->name('home');



Auth::routes(['register' => false]);
// Auth::routes();




//Route::get('/home', 'HomeController@index')->name('home');

//Route::view('forgot_password', 'auth.reset_password')->name('password.reset');


Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    return 'Cache cleared';
});

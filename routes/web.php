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



Auth::routes();

Route::post('/login', 'Auth\LoginController@login');
// Route::post('/logout', 'Auth\LoginController@logout');
// Route::post('/register', 'Auth\RegisterController@register');

Route::get('/logout ', 'UserController@logout');
//get user tracking 
Route::get('/usertracking ', 'TrackingController@usertracking');
Route::get('/userrole ', 'UserController@userrole');
Route::post('/changepass/{id}', 'UserController@changepass');

// Route::get('/home ', 'HomeController@index')->name('home');
Route::get('/{vue?}', function () { return view('/home/home'); })->where('vue', '[\/\w\.-]*');


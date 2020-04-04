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

Route::get('/registerStudent', function () {
    return view('student.registerStudent');
});

Route::get('/registerSuperadmin', function () {
    return view('superadmin.registerSuperadmin');
});

Route::get('/registerStudent', function () {
    return view('student.registerStudent');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'superadmin']], function() {
   
    Route::get('/superadmin', function () {
        return view('superadmin.dashboard');
    });
});

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


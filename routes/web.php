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


Auth::routes();

Route::get('/home',                 'HomeController@index')->name('home');

Route::post('/login',               'Auth\LoginController@login')->name('login');
Route::get('/logout',               'Auth\LoginController@logout')->name('logout');



/**
 * Routes for SuperAdmin Features
*/
// Route::group(['middleware' => ['auth', 'superadmin']], function() {   
//     Route::get('/superadmin', 'SuperAdminController@index')->name('superadmin.dashboard');
// });
Route::get('/superadmin/register', function () {
    return view('superadmin.registerSuperadmin');
})->name('superadmin.register');
Route::resource('/superadmins',            'SuperAdminController');

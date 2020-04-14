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

Auth::routes();
// Route::get('/login',                 'ViewsOnlyController@showLoginForm')->name('login');
Route::post('/verify-credentials',  'Auth\LoginController@verifyCredentials')->name('login.verify_credentials');
Route::get('/home',                 'HomeController@index')->name('home');
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
Route::resource('/superadmins',       'SuperAdminController');
Route::get('/superadmin/list',       'SuperAdminController@superAdminList')->name('superadmins.list');

/**
 * Routes for Admin Features
*/
Route::resource('/admins',            'AdminController');

Route::get('/humanresource/register', function () {
    return view('humanResource.registerHR');
})->name('humanresource.register');

/**
 * Routes for Human Resource Features
*/
Route::resource('/human-resource',    'HumanResourceController');

/**
 * Routes for College Features
*/
Route::resource('/colleges',          'CollegeController');


/**
 * Routes for Department Features
*/
Route::resource('/departments',       'DepartmentController');

/**
 * Routes for User Role Features
*/
Route::resource('/userRoles',       'UserRoleController');

/**
 * Routes for Academic Staff Features
*/
Route::resource('/academicstaffs',       'AcademicController');

/**
 * Routes for Courses Features
*/
Route::resource('/courses',       'CourseController');
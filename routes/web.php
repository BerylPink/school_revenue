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
// Route::get('/login',                   'ViewsOnlyController@showLoginForm')->name('login');
Route::post('/verify-credentials',        'Auth\LoginController@verifyCredentials')->name('login.verify_credentials');
Route::get('/home',                       'HomeController@index')->name('home');
Route::get('/logout',                     'Auth\LoginController@logout')->name('logout');



/**
 * Routes for SuperAdmin Features
*/
// Route::group(['middleware' => ['auth', 'superadmin']], function() {   
//     Route::get('/superadmin', 'SuperAdminController@index')->name('superadmin.dashboard');
// });
Route::get('/superadmin/register', function () {
    return view('superadmin.registerSuperadmin');
})->name('superadmin.register');
Route::resource('/superadmins',           'SuperAdminController');
Route::get('/superadmin/list',            'SuperAdminController@superAdminList')->name('superadmins.list');
Route::get('/settings/password/change',   'SuperAdminController@changePassword')->name('settings.change_password');
Route::put('/settings/password/update',   'SuperAdminController@updatePassword')->name('settings.update_password');

/**
 * Routes for Admin Features
*/
Route::resource('/viewsonly',                'ViewsOnlyController');

/**
 * Routes for Admin Features
*/
Route::resource('/admins',                'AdminController');


/**
 * Routes for Human Resource Features
*/
Route::resource('/human-resource',        'HumanResourceController');
Route::get('/humanresource/register', function () {
    return view('humanResource.registerHR');
})->name('humanresource.register');

/**
 * Routes for College Features
*/
Route::resource('/colleges',             'CollegeController');


/**
 * Routes for Department Features
*/
Route::resource('/departments',          'DepartmentController');


/**
 * Routes for User Role Features
*/
Route::resource('/userroles',            'UserRoleController');

/**
 * Routes for Student Features
*/
Route::resource('/students',             'StudentController');
Route::get('/students/college/departments',         'StudentController@getDepartmentsFromCollege')->name('colleges.departments');
Route::get('/student',                              'StudentController@studentDashboard')->name('students.dashboard');
Route::get('/student/profile',                      'StudentController@studentProfile')->name('students.profile');
Route::get('/student/profile/update',               'StudentController@studentUpdateProfileView')->name('students.update_profile_view');
Route::get('/student/payment/',                     'StudentController@studentPayment')->name('students.payment');
Route::get('/students/payment/fee-category',        'StudentController@getFeeCategory')->name('students.fee_category');
Route::get('/students/payment/fee-category-amount', 'StudentController@getFeeCategoryAmount')->name('students.fee_category_amount');
Route::get('/students/payment/histrory',            'StudentController@studentPaymentHistory')->name('students.payment_history');

/**
 * Routes for Academic Staff Features
*/
Route::resource('/academics',            'AcademicController');

/**
 * Routes for Non-Academic Staff Features
*/
Route::resource('/nonacademics',         'NonAcademicController');

/**
 * Routes for Courses Features
*/
Route::resource('/courses',              'CourseController');

/**
 * Routes for fee-Category Features
*/
Route::resource('/fee-categories',       'FeeCategoryController');

/**
 * Routes for expense-Category Features
*/
Route::resource('/expense-categories',   'ExpenseCategoryController');

/**
 * Routes for Expense Features
*/
Route::resource('/expenses',             'ExpenseController');

/**
 * Routes for Category Features
*/
Route::resource('/categories',           'CategoryController');

/**
 * Routes for Bank Details Features
*/
Route::resource('/banks',                'BankController');

/**
 * Routes for Payment Gateway Features
*/
Route::resource('/payment-gateways',     'PaymentGatewayController');

/**
 * Routes for Payments Features
*/
Route::resource('/payments',             'PaymentController');
Route::post('/payments/student/make-payment',           'PaymentController@studentMakePayment')->name('payments.student_payment');
Route::get('/payments/academic/payment-list',           'PaymentController@academicStaffPaymentsList')->name('payments.academic_list');
Route::get('/payments/academic/payment-show/{id}',      'PaymentController@academicStaffPaymentShow')->name('payments.academic_show');
Route::get('/payments/non-academic/payment-list',       'PaymentController@nonAcademicStaffPaymentsList')->name('payments.non_academic_list');
Route::get('/payments/non-academic/payment-show/{id}',  'PaymentController@nonAcademicStaffPaymentShow')->name('payments.non_academic_show');
Route::get('/payments/student/payment-list',            'PaymentController@StudentPaymentsList')->name('payments.student_list');

/**
 * Routes for Payments Category Features
*/
Route::resource('/payment-categories',   'PaymentCategoryController');

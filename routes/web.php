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

Route::get('/home', 'HomeController@index');
Route::get('/post', 'HomeController@getPost');

//Admin Route
Route::group(['prefix' => 'admin'], function () {
    Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\AdminLoginController@login')->name('admin.login.post');
    Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    Route::get('home', 'AdminController@index')->name('admin.home');
    Route::prefix('modules')->name('admin.modules.')->middleware('auth:admin')->group(function () {
        Route::resource('business-types', 'Admin\Modules\BusinessTypeController');
        Route::resource('city-provinces', 'Admin\Modules\CityProvinceController');
        Route::resource('contract-types', 'Admin\Modules\ContractTypeController');
        Route::resource('departments', 'Admin\Modules\DepartmentController');
        Route::resource('functions', 'Admin\Modules\FunctionController');
        Route::resource('industries', 'Admin\Modules\IndustryController');
        Route::resource('qualifications', 'Admin\Modules\QualificationController');
        Route::resource('levels', 'Admin\Modules\LevelController');
        Route::resource('languages', 'Admin\Modules\LanguageController');
        Route::resource('positions', 'Admin\Modules\PositionController');
    });
    Route::prefix('employees')->name('admin.employees.')->middleware('auth:admin')->group(function () {
        Route::get('manage', 'AdminController@employees')->name('manage');
        Route::get('un-verify-employee', 'AdminController@show_un_verify_emp')->name('show_un_verify_emp');
        Route::get('un-active-employee', 'AdminController@show_un_active_emp')->name('show_un_active_emp');
        Route::get('show-employee/{id}', 'AdminController@show_employee')->name('show-employee');
        Route::get('verify-employee/{id}', 'AdminController@verify_employee')->name('verify-employee');
    });

    Route::prefix('candidates')->name('admin.candidates.')->middleware('auth:admin')->group(function () {
        Route::get('/', 'Admin\CandidateController@index')->name('index');
        Route::get('un-active', 'Admin\CandidateController@get_un_active')->name('get_un_active');
        Route::get('un-active/{id}/show', 'Admin\CandidateController@show')->name('get_un_active.show');
    });
});

Route::resource('posts', 'Employee\PostController');

//Employee Route
Route::prefix('employee')->group(function () {
    Route::get('login', 'Auth\EmployeeLoginController@showLoginForm')->name('employee.login');
    Route::post('login', 'Auth\EmployeeLoginController@login')->name('employee.login.post');
    Route::post('logout', 'Auth\EmployeeLoginController@logout')->name('employee.logout');
    Route::get('home', 'EmployeeController@index')->name('employee.home');
});
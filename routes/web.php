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

Route::get('/', 'HomeController@index')->name('home');
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
        Route::get('change_status/{id}', 'Admin\CandidateController@change_status')->name('change_status');
        Route::get('un-verify', 'Admin\CandidateController@get_un_verify')->name('get_un_verify');
        Route::get('un-verify/{id}/show', 'Admin\CandidateController@show_un_verify')->name('show_un_verify');
        Route::get('verify/{id}', 'Admin\CandidateController@verify_candidate')->name('verify_candidate');
    });
});

Route::resource('posts', 'Employee\PostController');

//Employee Route
Route::prefix('employee')->name('employee.')->group(function () {

    Route::get('login', 'Auth\EmployeeLoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\EmployeeLoginController@login')->name('login.post');
    Route::post('logout', 'Auth\EmployeeLoginController@logout')->name('logout');
    Route::get('account-settings/change-password', 'Employee\EmployeeController@show_change_password')->name('account-settings.show-change-password');
    Route::post('account-settings/change/password', 'Employee\EmployeeController@change_password')->name('account-settings.change-password');

    Route::get('home', 'EmployeeController@index')->name('home');
    Route::get('account-settings/company-profile', 'Employee\EmployeeController@company_profile')->name('company_profile');
    Route::get('edit-profile', 'Employee\EmployeeController@edit_profile')->name('edit_profile');
    Route::patch('update-profile', 'Employee\EmployeeController@update_profile')->name('update_profile');
    Route::patch('update-profile-about', 'Employee\EmployeeController@update_profile_about')->name('update_profile_about');
    Route::get('posts/all', 'Employee\EmployeeController@posts')->name('posts.json');
    //Test api.
    //Route::get('posts', 'Employee\EmployeeController@posts')->name('posts');
    Route::get('posts/active', 'Employee\PostController@status_active')->name('posts.active');
    Route::get('posts/drafts', 'Employee\PostController@status_drafts')->name('posts.drafts');
    Route::get('posts/expired', 'Employee\PostController@status_expired')->name('posts.expired');
    Route::get('posts/unpublished', 'Employee\PostController@unpublished')->name('posts.unpublished');
    Route::get('posts/update_status/disabled/{num}', 'Employee\PostController@update_job_status')->name('update_job.status_filled_up');
    Route::get('posts/update_status/active/{num}', 'Employee\PostController@update_job_status')->name('update_job.status_active');
    Route::get('posts/update_status/filled_up/{num}', 'Employee\PostController@update_job_status')->name('update_job.status_disabled');

    Route::resource('posts', 'Employee\PostController');
    Route::get('posts/{id}/{draft}', 'Employee\PostController@edit_draft')->name('posts.edit.draft');

    // Contact
    Route::get('/contact-list', 'Employee\EmployeeController@contact_form')->name('contacts_data');
    Route::get('/contact-list/deleted', 'Employee\EmployeeController@get_contact_deleted')->name('get_contact_deleted_list');
    Route::get('/contact/deleted', 'Employee\ContactController@get_contact_deleted')->name('get_contact_deleted');
    Route::put('/contact/restore_contact/{id}', 'Employee\ContactController@restore_contact')->name('restore_contact');
    Route::resource('contacts', 'Employee\ContactController');
});
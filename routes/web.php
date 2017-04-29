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

Route::middleware('guest')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/post', 'HomeController@getPost');
    Route::get('view/job/{id}/{company}/{industry}/{slug}', 'HomeController@view_post')->name('home.view.job');
    //Route::post('view/job/{id}/{company}/{industry}/{slug}', 'HomeController@view_post')->name('home.view.job');
    Route::post('job/apply/{id}', 'HomeController@apply_job')->name('home.job.apply');

    //Search by
    Route::group(['prefix' => 'jobs'], function () {
        Route::name('jobs.view.by.')->group(function () {
            Route::get('function/{slug}', ['as' => 'function', 'uses' => 'HomeController@search_by_function']);
            Route::get('industry/{slug}', ['as' => 'industry', 'uses' => 'HomeController@search_by_industry']);
            Route::get('company/{slug}', ['as' => 'company', 'uses' => 'HomeController@search_by_company']);
            Route::get('city/{slug}', ['as' => 'city', 'uses' => 'HomeController@search_by_city']);
            Route::get('term/{slug}', 'HomeController@search_by_contract_term')->name('contract_term');
        });
        //For jobs all by specific
        Route::name('jobs.search.by.')->group(function () {
            Route::get('functions', ['as' => 'function.all', 'uses' => 'HomeController@all_functions']);
            Route::get('industries', ['as' => 'industry.all', 'uses' => 'HomeController@all_industries']);
            Route::get('companies', ['as' => 'company.all', 'uses' => 'HomeController@all_companies']);
            Route::get('cities', ['as' => 'city.all', 'uses' => 'HomeController@all_cities']);
        });
        Route::get('search/', 'HomeController@job_search')->name('jobs.search');
    });
});

//Admin Route
Route::group(['prefix' => 'admin'], function () {

    Route::get('cache-config', ['as' => 'admin.system.cache.config', 'uses' => 'Admin\ConfigController@cache_config']);
    Route::get('clear-cache', ['as' => 'admin.system.cache.clear', 'uses' => 'Admin\ConfigController@cache_clear']);
    Route::get('view-cache', ['as' => 'admin.system.view.clear', 'uses' => 'Admin\ConfigController@clear_view']);

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
    Route::get('register', 'Auth\EmployeeLoginController@showRegisterForm')->name('register');
    Route::post('save/register', 'Auth\EmployeeLoginController@saveRegisterForm')->name('register.account');
    Route::get('register/add-company-profile', 'Employee\EmployeeController@add_company_profile')->name('register.add_company_profile');
    Route::post('register/post/add-company-profile', 'Employee\EmployeeController@post_add_company_profile')->name('register.add_company_profile.post');
    Route::get('verify/{token}', 'Auth\EmployeeLoginController@verify')->name('verify.account');
    //====Employee Reset password====//
    Route::prefix('password')->name('password.')->group(function () {
        Route::get('reset', 'Auth\Employee\ForgotPasswordController@showLinkRequestForm')->name('request');
        Route::get('reset/{token}', 'Auth\Employee\ResetPasswordController@showResetForm')->name('request.form');
        Route::post('email', 'Auth\Employee\ForgotPasswordController@sendResetLinkEmail')->name('email');
        Route::post('request', 'Auth\Employee\ResetPasswordController@reset')->name('reset');
    });
    Route::get('login', 'Auth\EmployeeLoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\EmployeeLoginController@login')->name('login.post');
    Route::post('logout', 'Auth\EmployeeLoginController@logout')->name('logout');
    Route::get('account-settings/change-password', 'Employee\EmployeeController@show_change_password')->name('account-settings.show-change-password');
    Route::post('account-settings/change/password', 'Employee\EmployeeController@change_password')->name('account-settings.change-password');

    Route::get('home', 'Employee\EmployeeController@index')->name('home');
    Route::get('account-settings/company-profile', 'Employee\EmployeeController@company_profile')->name('company_profile');
    Route::get('edit-profile', 'Employee\EmployeeController@edit_profile')->name('edit_profile');
    Route::patch('update-profile', 'Employee\EmployeeController@update_profile')->name('update_profile');
    Route::patch('update-profile-about', 'Employee\EmployeeController@update_profile_about')->name('update_profile_about');
    //Test api.
    //Route::get('posts', 'Employee\EmployeeController@posts')->name('posts');
    Route::prefix('posts')->group(function () {
        Route::name('posts.')->group(function () {
            Route::get('all', 'Employee\EmployeeController@posts')->name('json');
            Route::get('active', 'Employee\PostController@status_active')->name('active');
            Route::get('drafts', 'Employee\PostController@status_drafts')->name('drafts');
            Route::get('expired', 'Employee\PostController@status_expired')->name('expired');
            Route::get('unpublished', 'Employee\PostController@unpublished')->name('unpublished');
            Route::get('{id}/{draft}', 'Employee\PostController@edit_draft')->name('edit.draft');
            Route::resource('/', 'Employee\PostController');
        });
        Route::prefix('update_status')->name('update_job.')->group(function () {
            Route::get('disabled/{num}', 'Employee\PostController@update_job_status')->name('status_filled_up');
            Route::get('active/{num}', 'Employee\PostController@update_job_status')->name('status_active');
            Route::get('filled_up/{num}', 'Employee\PostController@update_job_status')->name('status_disabled');
        });
    });
    // Contact
    Route::get('/contact-list', 'Employee\EmployeeController@contact_form')->name('contacts_data');
    Route::get('/contact-list/deleted', 'Employee\EmployeeController@get_contact_deleted')->name('get_contact_deleted_list');
    Route::get('/contact/deleted', 'Employee\ContactController@get_contact_deleted')->name('get_contact_deleted');
    Route::put('/contact/restore_contact/{id}', 'Employee\ContactController@restore_contact')->name('restore_contact');
    Route::resource('contacts', 'Employee\ContactController');
});

//Candidate section

Auth::routes();
Route::prefix('candidate')->name('candidate.')->group(function () {
    Route::get('/home', 'Candidate\HomeController@index')->name('home');

});
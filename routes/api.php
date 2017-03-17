<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//example url: /api/admin/..../....
Route::group(['middleware' => 'api'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::group(['prefix' => 'modules'], function () {
            Route::resource('business-types', 'Api\BusinessTypeController');
            Route::resource('city-provinces', 'Api\CityProvinceController');
            Route::resource('departments', 'Api\DepartmentController');
            Route::resource('functions', 'Api\FunctionController');
            Route::resource('industries', 'Api\IndustryController');
            Route::resource('qualifications', 'Api\QualificationController');
            Route::resource('levels', 'Api\LevelController');
            Route::resource('languages', 'Api\LanguageController');
            Route::resource('positions', 'Api\PositionController');
            Route::resource('contract-types', 'Api\ContractTypeController');
        });
        Route::prefix('employees')->name('admin.employees.')->group(function () {
            Route::resource('manage', 'Api\AdminController');
            Route::get('get-un-verify-employee', 'Api\AdminController@get_un_verify_employee');
            Route::get('get-un-active-employee', 'Api\AdminController@get_un_active_employee');
            //GET Post by user id.
            Route::get('jobs/{id}', 'Api\AdminController@employee_jobs')->name('jobs.all');
            Route::get('jobs-count/{id}/{count}', 'Api\AdminController@employee_jobs')->name('jobs.count-all');
            //Get jobs in tabs.
            Route::get('jobs-need-verify/{id}', 'Api\AdminController@get_need_verify_job')->name('jobs_need_verify');
            Route::get('get-jobs-available/{id}', 'Api\AdminController@get_jobs_available')->name('get_jobs_available');
            Route::get('get-job-filled-up/{id}', 'Api\AdminController@get_job_filled_up')->name('get_job_filled_up');
            Route::patch('update-job-status/{id}', 'Api\AdminController@update_job_status')->name('update_job_status');
            ///count jobs.
            Route::get('count-all-jobs/{id}', 'Api\AdminController@count_all_jobs')->name('count_all_jobs');
            Route::get('count-jobs-need-verified/{id}', 'Api\AdminController@count_need_verify_job')->name('count_need_verify_job');
            Route::get('count-jobs-available/{id}', 'Api\AdminController@count_jobs_available')->name('count_jobs_available');
            Route::get('count-jobs-filled-up/{id}', 'Api\AdminController@count_jobs_filled_up')->name('count_jobs_filled_up');
            //Verify employee.
            Route::get('verify-employee/{id}', 'Api\AdminController@verify_employee')->name('verify-employee')->middleware('auth:admin');
        });

        Route::prefix('candidates')->name('admin.candidates.')->group(function () {
            Route::get('/', 'Api\AdminController@get_candidate_list')->name('get_candidate_list');
            Route::get('get-un-active-candidate', 'Api\AdminController@get_un_active_candidate')->name('get_un_active_candidate');
            Route::get('get-un-verify-candidate', 'Api\AdminController@get_un_verify_candidate')->name('get_un_verify_candidate');
        });
    });
});

Route::prefix('employee')->name('employee.')->group(function () {
    Route::prefix('posts')->name('posts.')->group(function () {
        Route::get('all', 'Api\Employee\PostController@all_posts')->name('all');
    });
});
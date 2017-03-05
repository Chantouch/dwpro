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
        Route::resource('departments', 'Admin\Modules\DepartmentController');
        Route::resource('functions', 'Admin\Modules\FunctionController');
        Route::resource('industries', 'Admin\Modules\IndustryController');
        Route::resource('qualifications', 'Admin\Modules\QualificationController');
        Route::resource('levels', 'Admin\Modules\LevelController');
        Route::resource('languages', 'Admin\Modules\LanguageController');
        Route::resource('positions', 'Admin\Modules\PositionController');
//
    });
});

Route::resource('posts', 'Employee\PostController');
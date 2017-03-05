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
        });
    });
});
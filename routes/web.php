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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'checkLogin'], function () {
    Route::get('/', 'DashboardController@index');
    Route::resource('positions', 'PositionController');
    Route::resource('workspaces', 'WorkspaceController');
    Route::resource('programs', 'ProgramController');
    Route::resource('locations', 'LocationController');
    Route::resource('users', 'UserController');
    Route::group(['prefix' => 'calendar', 'as' => 'calendars.'], function () {
        Route::get('location/{id}', 'WorkingScheduleController@viewByLocation')->name('location.month');
        Route::get('location/get/{id}', 'WorkingScheduleController@getCalendar')->name('location.get_data');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'HomeController@logout');
Route::resource('user', 'UserController')->middleware('checkUser');

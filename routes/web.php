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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['checkLogin', 'CheckAdmin']], function () {
    Route::get('/', 'DashboardController@index')->name('admin.index');
    Route::resource('positions', 'PositionController');
    Route::resource('workspaces', 'WorkspaceController');
    Route::resource('programs', 'ProgramController');
    Route::resource('locations', 'LocationController');
    Route::resource('users', 'UserController');
    Route::resource('userdisables', 'UserDisableController');
    Route::group(['prefix' => 'schedule', 'as' => 'schedule.'], function () {
        Route::get('/', 'WorkingScheduleController@chooseWorkplace')->name('workplace.list');
        Route::get('/{id}', 'WorkingScheduleController@viewByWorkplace')->name('workplace.view');
        Route::get('/{id}/get', 'WorkingScheduleController@getData')->name('workplace.get_data');
        Route::get('/{id}/one', 'WorkingScheduleController@getOneDate')->name('workplace.get_one_date');
        Route::get('location/{id}', 'WorkingScheduleController@viewByLocation')->name('location.month');
        Route::get('users/{id}', 'WorkingScheduleController@viewByUser');
        Route::get('users/{id}/get', 'WorkingScheduleController@getDataUser');
    });
    Route::group(['prefix' => 'calendar', 'as' => 'calendar.'], function () {
        Route::get('/', 'SittingCalendarController@chooseWorkplace')->name('workplace.list');
        Route::get('/workplace/{id}', 'SittingCalendarController@locationList')->name('location.list');
        Route::get('location/{id}', 'SittingCalendarController@locationAnalystic')->name('location.view');
        Route::get('location/{id}/analystic', 'SittingCalendarController@getAnalysticData')->name('location.get_data');
        Route::get('location/{id}/detail/{date}', 'SittingCalendarController@detailLocation')->name('location.detail_location');
    });
});

Auth::routes();

Route::group(['middleware' => 'checkLogin'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/logout', 'HomeController@logout');
    Route::resource('user', 'UserController')->middleware('checkUser');
    Route::get('/workschedule-register', 'WorkScheduleController@index');
    Route::post('/registerworkschedule', 'WorkScheduleController@registerWork')->name('workschedule');
    Route::get('/workschedule', 'WorkScheduleController@index');
    Route::get('schedule/users/{id}', 'Admin\WorkingScheduleController@viewByUser')->name('user.schedule');
    Route::get('schedule/users/{id}/get', 'Admin\WorkingScheduleController@getDataUser');
});
Route::get('/register', 'UserController@index');
Route::post('/register', 'UserController@store');

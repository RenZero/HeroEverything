<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', 'IndexController@index');

Route::post('newBar', 'HealthApiController@newBar');
Route::post('editBar', 'HealthApiController@editBar');
Route::post('readBar', 'HealthApiController@readBar');
//Route::post('readPicBar', 'HealthApiController@readPicBar');
Route::post('readListBar', 'HealthApiController@readListBar');
Route::post('delBar', 'HealthApiController@delBar');
Route::post('writeBar', 'HealthApiController@writeBar');
Route::post('cronBar', 'HealthApiController@cronBar');
Route::post('eventBar', 'HealthApiController@eventBar');
Route::post('alertBar', 'HealthApiController@alertBar');

Route::get('auth', ['middleware' => 'auth', function () {
    echo 'test';
}]);

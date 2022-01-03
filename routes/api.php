<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('add_new_complaint','App\Http\Controllers\MetroCardAppController@add_new_complaint');

Route::get('retrieve_train_line','App\Http\Controllers\MetroCardAppController@retrieve_train_line');
Route::post('retrieve_station','App\Http\Controllers\MetroCardAppController@retrieve_station');
Route::post('retrieve_routes','App\Http\Controllers\MetroCardAppController@retrieve_routes');

Route::get('retrieve_fare','App\Http\Controllers\MetroCardAppController@retrieve_fare');

Route::post('login','App\Http\Controllers\MetroCardAppController@login'); 

//GET MEthod With Parameter Not working wuth this API
Route::post('retrieve_balance','App\Http\Controllers\MetroCardAppController@retrieve_balance');
Route::post('recharge_balance','App\Http\Controllers\MetroCardAppController@recharge_balance');

Route::post('retrieve_recharge_history','App\Http\Controllers\MetroCardAppController@retrieve_recharge_history');
Route::post('retrieve_travel_history','App\Http\Controllers\MetroCardAppController@retrieve_travel_history');

Route::post('change_pin','App\Http\Controllers\MetroCardAppController@change_card_pin');

Route::post('forgot_password_getPhone','App\Http\Controllers\MetroCardAppController@forgot_password_getPhone');
Route::post('update_card_pin','App\Http\Controllers\MetroCardAppController@update_card_pin');

Route::post('journey_Fare','App\Http\Controllers\MetroCardAppController@journey_Fare');

Route::post('test_journey_Fare','App\Http\Controllers\MetroCardAppController@test_journey_Fare');

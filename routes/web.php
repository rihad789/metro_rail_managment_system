<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect('dashboard');
});

require __DIR__ . '/auth.php';


Route::group(['middleware' => ['auth']], function () {

    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
});


//For admin
Route::group(['middleware' => ['auth', 'role:admin']], function () {


    //Admin Side Nav Route
    Route::get('admin', 'App\Http\Controllers\Admin\DashboardController@index')->name('dashboard');
    Route::get('admin/station', 'App\Http\Controllers\Admin\DashboardController@station')->name('stations');
    Route::get('admin/routes', 'App\Http\Controllers\Admin\DashboardController@routes')->name('routes');
    Route::get('admin/users', 'App\Http\Controllers\Admin\DashboardController@users')->name('users');

    
    //Fare Route
    Route::get('admin/fare', 'App\Http\Controllers\Admin\DashboardController@fare')->name('fare');
    Route::post('admin/fare/update', 'App\Http\Controllers\Admin\DashboardController@update_fare')->name('update_fare');


    //User Route
    Route::get('admin/profile', 'App\Http\Controllers\Admin\UserController@admin_profile')->name('profile');
    Route::post('admin/profile/update', 'App\Http\Controllers\Admin\UserController@admin_profile_update')->name('update_profile');

    Route::get('admin/account', 'App\Http\Controllers\Admin\UserController@admin_account')->name('account');
    Route::post('admin/account/update', 'App\Http\Controllers\Admin\UserController@update_admin_account')->name('update_account');
    Route::post('admin/account/update_password', 'App\Http\Controllers\Admin\UserController@admin_update_password')->name('update_password');


    //Train Line Route
    Route::get('admin/train_line', 'App\Http\Controllers\Admin\TrainLineController@index')->name('train_line');
    Route::post('admin/train_line/add', 'App\Http\Controllers\Admin\TrainLineController@add_train_line')->name('add_train_line');
    Route::get('admin/train_line/view/{id}', 'App\Http\Controllers\Admin\TrainLineController@view_train_line')->name('view_train_line');
    Route::post('admin/train_line/edit', 'App\Http\Controllers\Admin\TrainLineController@edit_train_line')->name('edit_train_line');
    Route::get('admin/train_line/delete/{id}', 'App\Http\Controllers\Admin\TrainLineController@delete_train_line')->name('delete_train_line');


    //Station Route
    Route::get('admin/stations', 'App\Http\Controllers\Admin\StationController@index')->name('station');
    Route::post('admin/stations/add', 'App\Http\Controllers\Admin\StationController@add_station')->name('add_station');
    Route::get('admin/stations/view/{id}', 'App\Http\Controllers\Admin\StationController@view_station')->name('view_station');
    Route::post('admin/stations/edit', 'App\Http\Controllers\Admin\StationController@edit_station')->name('edit_station');
    Route::get('admin/stations/delete/{id}', 'App\Http\Controllers\Admin\StationController@delete_station')->name('delete_station');


    //Train Routes Route
    Route::get('admin/routes', 'App\Http\Controllers\Admin\RoutesController@index')->name('routes');
    Route::post('admin/routes/add', 'App\Http\Controllers\Admin\RoutesController@add_routes')->name('add_routes');
    Route::get('admin/routes/delete/{id}', 'App\Http\Controllers\Admin\RoutesController@delete_routes')->name('delete_routes');
    Route::get('admin/routes/getStations/{id}', 'App\Http\Controllers\Admin\RoutesController@getStations')->name('getStations');


    //Users Route
    Route::get('admin/users', 'App\Http\Controllers\Admin\UserController@users')->name('users');
    Route::post('admin/users/add', 'App\Http\Controllers\Admin\UserController@add_users')->name('add_users');
    Route::get('admin/users/view/{id}', 'App\Http\Controllers\Admin\UserController@view_users')->name('view_users');
    Route::post('admin/users/update', 'App\Http\Controllers\Admin\UserController@update_users')->name('edit_users');
    Route::get('admin/users/delete/{id}', 'App\Http\Controllers\Admin\UserController@delete_users')->name('delete_users');
});


//For Operator
Route::group(['middleware' => ['auth', 'role:operator']], function () {


    //Operator Side Nav Route
    Route::get('operator', 'App\Http\Controllers\Operator\DashboardController@index')->name('dashboard');
    Route::get('operator/complaint', 'App\Http\Controllers\Operator\DashboardController@complaint')->name('complaint');
    Route::get('operator/metrocard', 'App\Http\Controllers\Operator\DashboardController@metrocard')->name('metrocard');


    //Metro Card Route
    Route::post('operator/metrocard/register', 'App\Http\Controllers\Operator\MetroCardController@register_metro_card_user')->name('register');
    Route::get('operator/metrocard/view/{id}', 'App\Http\Controllers\Operator\MetroCardController@view_metro_card_user')->name('view');
    Route::post('operator/metrocard/issue_new_card', 'App\Http\Controllers\Operator\MetroCardController@issue_new_card')->name('issue');

    Route::get('operator/metrocard/viewCard', 'App\Http\Controllers\Operator\MetroCardController@view_metro_card')->name('viewCard');
    Route::post('operator/metrocard/updateCard', 'App\Http\Controllers\Operator\MetroCardController@update_metro_card')->name('updateCard');


    //Complaint Routes
    Route::get('operator/complaint/view/{id}', 'App\Http\Controllers\Operator\MetroCardController@view_complaint')->name('viewComplaint');
    Route::post('operator/complaint/update', 'App\Http\Controllers\Operator\MetroCardController@update_complaint_status')->name('updateComplaint');


    //User Route
    Route::get('operator/profile', 'App\Http\Controllers\Operator\UserController@index')->name('profile');
    Route::post('operator/profile/update', 'App\Http\Controllers\Operator\UserController@update_profile')->name('update');

    Route::get('operator/account', 'App\Http\Controllers\Operator\UserController@account')->name('account');
    Route::post('operator/account/update', 'App\Http\Controllers\Operator\UserController@update_operator_account')->name('update_operator_account');
    Route::post('operator/account/update_password', 'App\Http\Controllers\Operator\UserController@update_password')->name('update_password');
});



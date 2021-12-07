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

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');

Route::get('email/verify/{id}', 'Api\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Api\VerificationController@resend')->name('verification.resend');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('orderbus', 'Api\OrderBusController@index');
    Route::get('orderbus/{id}', 'Api\OrderBusController@show');
    Route::post('orderbus', 'Api\OrderBusController@store');
    Route::put('orderbus/{id}', 'Api\OrderBusController@update');
    Route::delete('orderbus/{id}', 'Api\OrderBusController@destroy');

    Route::get('orderkereta', 'Api\OrderKeretaController@index');
    Route::get('orderkereta/{id}', 'Api\OrderKeretaController@show');
    Route::post('orderkereta', 'Api\OrderKeretaController@store');
    Route::put('orderkereta/{id}', 'Api\OrderKeretaController@update');
    Route::delete('orderkereta/{id}', 'Api\OrderKeretaController@destroy');

    Route::get('orderpesawat', 'Api\OrderPesawatController@index');
    Route::get('orderpesawat/{id}', 'Api\OrderPesawatController@show');
    Route::post('orderpesawat', 'Api\OrderPesawatController@store');
    Route::put('orderpesawat/{id}', 'Api\OrderPesawatController@update');
    Route::delete('orderpesawat/{id}', 'Api\OrderPesawatController@destroy');

    Route::get('tiketbus', 'Api\TiketBusController@index');
    Route::get('tiketbus/{id}', 'Api\TiketBusController@show');
    Route::post('tiketbus', 'Api\TiketBusController@store');
    Route::put('tiketbus/{id}', 'Api\TiketBusController@update');
    Route::delete('tiketbus/{id}', 'Api\TiketBusController@destroy');

    Route::get('tiketkereta', 'Api\TiketKeretaController@index');
    Route::get('tiketkereta/{id}', 'Api\TiketKeretaController@show');
    Route::post('tiketkereta', 'Api\TiketKeretaController@store');
    Route::put('tiketkereta/{id}', 'Api\TiketKeretaController@update');
    Route::delete('tiketkereta/{id}', 'Api\TiketKeretaController@destroy');

    Route::get('tiketpesawat', 'Api\TiketPesawatController@index');
    Route::get('tiketpesawat/{id}', 'Api\TiketPesawatController@show');
    Route::post('tiketpesawat', 'Api\TiketPesawatController@store');
    Route::put('tiketpesawat/{id}', 'Api\TiketPesawatController@update');
    Route::delete('tiketpesawat/{id}', 'Api\TiketPesawatController@destroy');

    Route::get('user', 'Api\UserController@index');
    Route::get('user/{id}', 'Api\UserController@show');
    Route::post('user', 'Api\UserController@store');
    Route::put('user/{id}', 'Api\UserController@update');
    Route::delete('user/{id}', 'Api\UserController@destroy');

    Route::post('logout', 'Api\AuthController@logout');
});
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

Route::post('/login','ApiLoginController@login');

Route::middleware('auth:api')->group(function () {

	Route::get('/customers','PaymentsApiController@customers');
	Route::get('/vehicles','PaymentsApiController@vehicles');
	Route::get('/types','PaymentsApiController@types');
	Route::post('/vehicles/payments','PaymentsApiController@vPayments');
	Route::post('/customers/payments','PaymentsApiController@cPayments');
	Route::post('/logout','ApiLoginController@logout');
    
});


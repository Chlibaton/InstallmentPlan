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


//system user
Route::get('/user','UserController@index');
Route::post('/usercreate','UserController@register');
Route::put('/userupdate','UserController@update');
Route::delete('/userdelete/{id}','UserController@destroy');

// Tracking
Route::get('/trackinginit','TrackingController@index');
Route::post('/trackingcreate','TrackingController@create');
Route::put('/trackingupdate','TrackingController@update');
Route::delete('/trackingdelete/{id}','TrackingController@destroy');

// Tracking of Payments
Route::get('/trackingpaymentinit/{id}','TrackingPaymentsController@index');
Route::post('/trackingpaymentcreate','TrackingPaymentsController@create');
Route::put('/trackingpaymentupdate','TrackingPaymentsController@update');
Route::post('/updatebalance/{id}','TrackingPaymentsController@updatebalance');

//customer tracking
Route::get('/customertracking/{id}','TrackingController@customertracking');
Route::put('/u_u_receipt','TrackingPaymentsController@updateImage');

// collection Report 
Route::get('/reportInit','CollectionReportController@index');

// history logs
Route::get('/historyinit','HistoryLogsController@index');

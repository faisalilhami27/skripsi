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

Route::get('verifyAccount/{key}', 'Api\RegisterCustomerController@verify');
Route::get('forgotPassword', 'Api\ForgotPasswordController@forgotPassword');
Route::get('resetPassword/{username}', 'Api\ForgotPasswordController@resetPassword');
Route::post('changePassword', 'Api\ForgotPasswordController@changePassword');
Route::post('register', 'Api\RegisterCustomerController@register');
Route::post('login', 'Api\AuthenticationController@login');

Route::middleware(['auth:api_customer'])->group(function () {
    // Route Customer
    Route::prefix('customer')->group(function () {
        Route::get('getDataUser', 'Api\AuthenticationController@getAuthenticatedUser');
        Route::get('getCustomer', 'Api\CustomerController@show');
        Route::post('updateDataCustomer', 'Api\CustomerController@update');
    });

    // Route Pemesanan
    Route::prefix('pemesanan')->group(function () {
        Route::get('getPemesanan', 'Api\PemesananController@show');
        Route::get('getPemesananByCustomer', 'Api\PemesananController@getPemesananByIdCustomer');
        Route::post('insertPemesanan', 'Api\PemesananController@store');
    });

    // Route Content Mobile
    Route::prefix('mobile')->group(function () {
        Route::get('contentMobile', 'Api\KonfigurasiMobileController@index');
    });

    // Route Content Mobile
    Route::prefix('pembayaran')->group(function () {
        Route::post('uploadBukti', 'Api\PembayaranController@update');
    });
});

Route::middleware(['auth:api_karyawan'])->group(function () {
    Route::prefix('scan')->group(function () {
        Route::put('verifyDataByQRCode', 'Api\PemesananController@verifyDataByQRCode');
    });
});

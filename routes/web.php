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


use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@index');

Route::get('/auth', "AuthController@index");
Route::get('/blokir', "AuthController@blokir");
Route::get('/logout', "AuthController@logout");
Route::post('auth/checklogin', "AuthController@checkLogin");

Route::group(['prefix' => 'dashboard'], function (){
    Route::get('/', 'DashboardController@index');
    Route::get('/chart', 'DashboardController@chartForDataByDay');
    Route::get('/notif', 'DashboardController@getNotification');
    Route::put('/update', 'DashboardController@updateNotif');
    Route::get('/chart1', 'DashboardController@chartForDataByMonth');
    Route::put('/update', 'DashboardController@updateNotif');
    Route::get('/chart1', 'DashboardController@chartForDataByMonth');
});

Route::group(['prefix' => 'userlevel'], function (){
    Route::get('/', 'UserLevelController@index');
    Route::get('/json', 'UserLevelController@datatable');
    Route::get('/getakses/{id}', 'UserLevelController@show');
    Route::get('/getLevelById', 'UserLevelController@edit');
    Route::post('/insert/', 'UserLevelController@store');
    Route::put('/update', 'UserLevelController@update');
    Route::put('/updateAccess', 'UserLevelController@updateAccess');
    Route::post('/ubahprivilige', 'UserLevelController@changePrivilege');
    Route::delete('/delete', 'UserLevelController@destroy');
});

Route::group(['prefix' => 'user'], function (){
    Route::get('/', 'UserController@index');
    Route::get('/json', 'UserController@datatable');
    Route::get('/cekUsername', 'UserController@cekUsername');
    Route::get('/cekEmail', 'UserController@cekEmail');
    Route::get('/getUserById', 'UserController@edit');
    Route::post('/insert', 'UserController@store');
    Route::put('/resetpassword', 'UserController@resetPassword');
    Route::put('/update', 'UserController@update');
    Route::delete('/delete', 'UserController@destroy');
});

Route::group(['prefix' => 'kelolamenu'], function () {
    Route::get('/', 'MenuController@index');
    Route::get('/json', 'MenuController@datatable');
    Route::get('/getMenu', 'MenuController@edit');
    Route::post('/insert/', 'MenuController@store');
    Route::put('/update', 'MenuController@update');
    Route::delete('/delete', 'MenuController@destroy');
});

Route::group(['prefix' => 'pemesanan'], function (){
    Route::get('/', 'PemesananController@index');
    Route::get('/getall', 'PemesananController@getAll');
    Route::get('/json', 'PemesananController@datatable');
    Route::get('/getPemesananById', 'PemesananController@getPemesananById');
    Route::get('/printTicket/{id}', 'PemesananController@printTicket');
    Route::post('/insert', 'PemesananController@store');
    Route::put('/update', 'PemesananController@update');
    Route::delete('/delete', 'PemesananController@destroy');
});

Route::group(['prefix' => 'konfigurasi'], function (){
    Route::get('/', 'KonfigurasiController@index');
    Route::post('/update', 'KonfigurasiController@update');
});

Route::group(['prefix' => 'konfirmasi'], function (){
    Route::get('/', 'KonfirmasiPembayaranController@index');
    Route::get('/json', 'KonfirmasiPembayaranController@datatable');
    Route::get('/getKonfirmasiById', 'KonfirmasiPembayaranController@edit');
    Route::put('/update', 'KonfirmasiPembayaranController@update');
    Route::delete('/delete', 'KonfirmasiPembayaranController@destroy');
});

Route::group(['prefix' => 'profile'], function (){
    Route::get('/', 'ProfileController@index');
    Route::get('/cekUsername', 'UserController@cekUsername');
    Route::post('/update', 'ProfileController@update');
    Route::put('/changepassword', 'ProfileController@changePassword');
});

Route::group(['prefix' => 'mobile'], function () {
    Route::get('/', 'KonfigurasiMobileController@index');
    Route::get('/json', 'KonfigurasiMobileController@datatable');
    Route::get('/getMobile', 'KonfigurasiMobileController@edit');
    Route::post('/insert/', 'KonfigurasiMobileController@store');
    Route::put('/update', 'KonfigurasiMobileController@update');
    Route::delete('/delete', 'KonfigurasiMobileController@destroy');
});

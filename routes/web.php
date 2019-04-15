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

Route::get('/auth', "AuthController@index")->name('auth');
Route::get('/blokir', "AuthController@blokir");
Route::get('/logout', "AuthController@logout");
Route::get('/role', "ChooseRoleController@index");
Route::get('/link', "ChooseRoleController@linkDashboard");
Route::post('auth/checklogin', "AuthController@checkLogin");

// modul profile
Route::group(['prefix' => 'profile'], function () {
    Route::get('/', 'ProfileController@index');
    Route::get('/cekUsername', 'UserController@cekUsername');
    Route::post('/update', 'ProfileController@update');
    Route::put('/changepassword', 'ProfileController@changePassword');
});

Route::middleware(['checkRole'])->group(function () {
    Route::get('/', 'DashboardController@index');

    // modul dashboard
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', 'DashboardController@index');
        Route::get('/chart', 'DashboardController@chartForDataByDay');
        Route::get('/notif', 'DashboardController@getNotification');
        Route::get('/chart1', 'DashboardController@chartForDataByMonth');
        Route::put('/update', 'DashboardController@updateNotif');
    });

    // modul user level
    Route::group(['prefix' => 'userlevel'], function () {
        Route::get('/', 'UserLevelController@index');
        Route::get('/getMenu', 'UserLevelController@getMenu');
        Route::post('/json', 'UserLevelController@datatable');
        Route::post('/json2/{id}', 'UserLevelController@datatable2');
        Route::get('/getakses/{id}', 'UserLevelController@show');
        Route::get('/getLevelById', 'UserLevelController@edit');
        Route::post('/insert/', 'UserLevelController@store');
        Route::put('/update', 'UserLevelController@update');
        Route::put('/updateAccess', 'UserLevelController@updateAccess');
        Route::post('/ubahprivilige', 'UserLevelController@changePrivilege');
        Route::delete('/delete', 'UserLevelController@destroy');
    });

    // modul user
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@index');
        Route::post('/json', 'UserController@datatable');
        Route::get('/cekUsername', 'UserController@cekUsername');
        Route::get('/cekEmail', 'UserController@cekEmail');
        Route::get('/cekNoHp', 'UserController@cekNoHp');
        Route::get('/getUserById', 'UserController@edit');
        Route::post('/insert', 'UserController@store');
        Route::put('/resetpassword', 'UserController@resetPassword');
        Route::put('/update', 'UserController@update');
        Route::delete('/delete', 'UserController@destroy');
    });

    // modul kelola menu
    Route::group(['prefix' => 'kelolamenu'], function () {
        Route::get('/', 'MenuController@index');
        Route::post('/json', 'MenuController@datatable');
        Route::get('/getMenu', 'MenuController@edit');
        Route::post('/insert/', 'MenuController@store');
        Route::put('/update', 'MenuController@update');
        Route::delete('/delete', 'MenuController@destroy');
    });

    // modul pemesanan
    Route::group(['prefix' => 'pemesanan'], function () {
        Route::get('/', 'PemesananController@index');
        Route::get('/show/{id}', 'PemesananController@show');
        Route::post('/json', 'PemesananController@datatable');
        Route::get('/getPemesananById', 'PemesananController@edit');
        Route::get('/printTicket/{id}', 'PemesananController@printTicket');
        Route::post('/insert', 'PemesananController@store');
        Route::put('/update', 'PemesananController@update');
        Route::delete('/delete', 'PemesananController@destroy');
    });

    Route::group(['prefix' => 'konfigurasi'], function () {
        Route::get('/', 'KonfigurasiController@index');
        Route::post('/update', 'KonfigurasiController@update');
    });

    // modul pembayaran
    Route::group(['prefix' => 'konfirmasi'], function () {
        Route::get('/', 'KonfirmasiPembayaranController@index');
        Route::post('/json', 'KonfirmasiPembayaranController@datatable');
        Route::get('/getKonfirmasiById', 'KonfirmasiPembayaranController@edit');
        Route::get('/getKodePemesanan', 'KonfirmasiPembayaranController@getKodePemesanan');
        Route::get('/getBuktiPembayaran', 'KonfirmasiPembayaranController@getBuktiPembayaran');
        Route::put('/update', 'KonfirmasiPembayaranController@update');
        Route::delete('/delete', 'KonfirmasiPembayaranController@destroy');
    });

    // modul konfiguasi mobile
    Route::group(['prefix' => 'mobile'], function () {
        Route::get('/', 'KonfigurasiMobileController@index');
        Route::post('/json', 'KonfigurasiMobileController@datatable');
        Route::get('/getMobile', 'KonfigurasiMobileController@edit');
        Route::post('/insert/', 'KonfigurasiMobileController@store');
        Route::post('/update', 'KonfigurasiMobileController@update');
        Route::delete('/delete', 'KonfigurasiMobileController@destroy');
    });

// modul kelola karyawan
    Route::group(['prefix' => 'karyawan'], function () {
        Route::get('/', 'KaryawanController@index');
        Route::post('/json', 'KaryawanController@datatable');
        Route::get('/getKaryawan', 'KaryawanController@edit');
        Route::post('/insert/', 'KaryawanController@store');
        Route::put('/update', 'KaryawanController@update');
        Route::delete('/delete', 'KaryawanController@destroy');
    });

// modul kelola customer
    Route::group(['prefix' => 'customer'], function () {
        Route::get('/', 'CustomerController@index');
        Route::post('/json', 'CustomerController@datatable');
        Route::get('/getCustomer', 'CustomerController@edit');
        Route::put('/update', 'CustomerController@update');
        Route::delete('/delete', 'CustomerController@destroy');
    });
});




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
Route::get('/', function () {
    return view('login'); /* arahkan ke halaman login */
});

Route::get('/login', function () {
    return view('login'); /* arahkan ke halaman login */
});
Route::get('/dashboard', function () {
    return view('dashboard'); /* arahkan ke halaman dashboard */
});


Route::get('/supervisor', function () {
    return view('dashboardSupervisor');
});

//Route Resource
Route::resource('/projek',\App\Http\Controllers\ProjekController::class);
Route::get('projek/edit/{id}', '\App\Http\Controllers\ProjekController@edit');
Route::post('projek/update/{id}', '\App\Http\Controllers\ProjekController@update');

Route::get('/cekLogin', '\App\Http\Controllers\LoginController@cekLogin')->name('login.cekLogin');
Route::get('/projek/supervisor/index/{id}', '\App\Http\Controllers\ProjekController@indexbyidSupervisor')->name('projek.indexbyidSupervisor');

Route::get('/tim/index/{id}', '\App\Http\Controllers\TimController@indexTim')->name('tim.indexTim');
Route::get('/tim/create/{id}', '\App\Http\Controllers\TimController@createTim')->name('tim.createTim');
Route::get('/tim/store/{id}', '\App\Http\Controllers\TimController@storeTim')->name('tim.storeTim');
Route::get('/supervisor/tim/edit/{idc}/{id}', '\App\Http\Controllers\TimController@editTim')->name('tim.editTim');
Route::get('/supervisor/tim/update/{idc}/{id}', '\App\Http\Controllers\TimController@updateTim')->name('tim.updateTim');
Route::get('/supervisor/tim/destroy/{idc}/{id}', '\App\Http\Controllers\TimController@destroyTim')->name('tim.destroyTim');

Route::get('/client/index/{id}', '\App\Http\Controllers\ClientController@indexClient')->name('client.indexClient');
Route::get('/client/create/{id}', '\App\Http\Controllers\ClientController@createClient')->name('client.createClient');
Route::get('/client/store/{id}', '\App\Http\Controllers\ClientController@storeClient')->name('client.storeClient');
Route::get('/supervisor/client/edit/{idc}/{id}', '\App\Http\Controllers\ClientController@editClient')->name('client.editClient');
Route::get('/supervisor/client/update/{idc}/{id}', '\App\Http\Controllers\ClientController@updateClient')->name('client.updateClient');
Route::get('/supervisor/client/destroy/{idc}/{id}', '\App\Http\Controllers\ClientController@destroyClient')->name('client.destroyClient');

Route::get('/projek/supervisor/create/{id}', '\App\Http\Controllers\ProjekController@createProjek')->name('projek.createProjek');
Route::get('/projek/supervisor/store/{id}', '\App\Http\Controllers\ProjekController@storeProjek')->name('projek.storeProjek');
Route::get('/projek/tim/index/{id}', '\App\Http\Controllers\ProjekController@indexbyidTim')->name('projek.indexbyidTim');

Route::get('/projek/client/index/{id}', '\App\Http\Controllers\ProjekController@indexbyidClient')->name('projek.indexbyidClient');

Route::resource('/supervisor',\App\Http\Controllers\SupervisorController::class);
Route::get('supervisor/edit/{id}', '\App\Http\Controllers\SupervisorController@edit');
Route::post('supervisor/update/{id}', '\App\Http\Controllers\SupervisorController@update');

Route::resource('/tim',\App\Http\Controllers\TimController::class);
Route::get('tim/edit/{id}', '\App\Http\Controllers\TimController@edit');
Route::post('tim/update/{id}', '\App\Http\Controllers\TimController@update');

Route::resource('/client',\App\Http\Controllers\ClientController::class);
Route::get('client/edit/{id}', '\App\Http\Controllers\ClientController@edit');
Route::post('client/update/{id}', '\App\Http\Controllers\ClientController@update');

Route::get('/client/indexPassword/{id}', '\App\Http\Controllers\ClientController@indexPassword')->name('client.indexPassword');
Route::get('/client/ubahPassword/{id}', '\App\Http\Controllers\ClientController@ubahPassword')->name('client.ubahPassword');

Route::get('/tim/indexPassword/{id}', '\App\Http\Controllers\TimController@indexPassword')->name('tim.indexPassword');
Route::get('/tim/ubahPassword/{id}', '\App\Http\Controllers\TimController@ubahPassword')->name('tim.ubahPassword');

Route::get('/supervisor/indexPassword/{id}', '\App\Http\Controllers\SupervisorController@indexPassword')->name('supervisor.indexPassword');
Route::get('/supervisor/ubahPassword/{id}', '\App\Http\Controllers\SupervisorController@ubahPassword')->name('supervisor.ubahPassword');

Route::get('/client/indexAdmin', '\App\Http\Controllers\ClientController@indexAdmin')->name('client.indexAdmin');
Route::get('/client/resetPasswordClient/{id}', '\App\Http\Controllers\ClientController@resetPasswordClient')->name('client.resetPasswordClient');

Route::get('/tim/indexAdmin', '\App\Http\Controllers\TimController@indexAdmin')->name('tim.indexAdmin');
Route::get('/tim/resetPasswordTim/{id}', '\App\Http\Controllers\TimController@resetPasswordTim')->name('tim.resetPasswordTim');

Route::get('/supervisor/resetPasswordSupervisor/{id}', '\App\Http\Controllers\SupervisorController@resetPasswordSupervisor')->name('supervisor.resetPasswordSupervisor');
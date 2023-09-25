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
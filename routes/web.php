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
Route::delete('admin/projek/batal/{id}', '\App\Http\Controllers\ProjekController@destroyBatal')->name('projek.destroyBatal');
Route::delete('admin/projek/selesai/{id}', '\App\Http\Controllers\ProjekController@destroySelesai')->name('projek.destroySelesai');
Route::get('admin/projek/selesai', '\App\Http\Controllers\ProjekController@projekSelesai')->name('projek.projekSelesai');
Route::get('history/projek/supervisor/{id}', '\App\Http\Controllers\ProjekController@historySupervisor')->name('projek.historySupervisor');
Route::get('history/projek/tim/{id}', '\App\Http\Controllers\ProjekController@historyTim')->name('projek.historyTim');
Route::get('history/projek/client/{id}', '\App\Http\Controllers\ProjekController@historyClient')->name('projek.historyClient');
Route::get('batal/projek/{id}', '\App\Http\Controllers\ProjekController@batalProjek')->name('projek.batalProjek');
Route::get('admin/projek/batal', '\App\Http\Controllers\ProjekController@projekBatal')->name('projek.projekBatal');

Route::get('/cekLogin', '\App\Http\Controllers\LoginController@cekLogin')->name('login.cekLogin');
Route::get('/projek/supervisor/index/{id}', '\App\Http\Controllers\ProjekController@indexbyidSupervisor')->name('projek.indexbyidSupervisor');

Route::get('/tim/index/{id}', '\App\Http\Controllers\TimController@indexTim')->name('tim.indexTim');
Route::get('/tim/create/{id}', '\App\Http\Controllers\TimController@createTim')->name('tim.createTim');
Route::get('/tim/store/{id}', '\App\Http\Controllers\TimController@storeTim')->name('tim.storeTim');
Route::get('/supervisor/tim/edit/{idc}/{id}', '\App\Http\Controllers\TimController@editTim')->name('tim.editTim');
Route::get('/supervisor/tim/update/{idc}/{id}', '\App\Http\Controllers\TimController@updateTim')->name('tim.updateTim');
Route::delete('/supervisor/tim/destroy/{idt}/{id}', '\App\Http\Controllers\TimController@destroyTim')->name('tim.destroyTim');

Route::get('/client/index/{id}', '\App\Http\Controllers\ClientController@indexClient')->name('client.indexClient');
Route::get('/client/create/{id}', '\App\Http\Controllers\ClientController@createClient')->name('client.createClient');
Route::get('/client/store/{id}', '\App\Http\Controllers\ClientController@storeClient')->name('client.storeClient');
Route::get('/supervisor/client/edit/{idc}/{id}', '\App\Http\Controllers\ClientController@editClient')->name('client.editClient');
Route::get('/supervisor/client/update/{idc}/{id}', '\App\Http\Controllers\ClientController@updateClient')->name('client.updateClient');
Route::delete('/supervisor/client/destroy/{idc}/{id}', '\App\Http\Controllers\ClientController@destroyClient')->name('client.destroyClient');

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

Route::get('/client/admin/tampilAdmin', '\App\Http\Controllers\ClientController@indexAdmin')->name('client.indexAdmin');
Route::get('/client/resetPasswordClient/{id}', '\App\Http\Controllers\ClientController@resetPasswordClient')->name('client.resetPasswordClient');

Route::get('/tim/admin/tampilAdmin', '\App\Http\Controllers\TimController@indexAdmin')->name('tim.indexAdmin');
Route::get('/tim/resetPasswordTim/{id}', '\App\Http\Controllers\TimController@resetPasswordTim')->name('tim.resetPasswordTim');

Route::get('/supervisor/resetPasswordSupervisor/{id}', '\App\Http\Controllers\SupervisorController@resetPasswordSupervisor')->name('supervisor.resetPasswordSupervisor');

Route::get('/chat/index/client/{idc}/{idt}/{idp}', '\App\Http\Controllers\ChatController@indexClient')->name('chat.indexClient');
Route::get('/chat/store/client/{idc}/{idt}/{idp}', '\App\Http\Controllers\ChatController@storeClient')->name('chat.storeClient');
Route::get('/chat/index/tim/{idc}/{idt}/{idp}', '\App\Http\Controllers\ChatController@indexTim')->name('chat.indexTim');
Route::get('/chat/store/tim/{idc}/{idt}/{idp}', '\App\Http\Controllers\ChatController@storeTim')->name('chat.storeTim');

Route::get('/jadwal/index/supervisor/{ids}', '\App\Http\Controllers\JadwalController@indexSupervisor')->name('jadwal.indexSupervisor');
Route::get('/jadwal/create/supervisor/{id}', '\App\Http\Controllers\JadwalController@createJadwal')->name('jadwal.createJadwal');
Route::get('/jadwal/store/supervisor/{ids}', '\App\Http\Controllers\JadwalController@storeSupervisor')->name('jadwal.storeSupervisor');
Route::get('/jadwal/edit/supervisor/{idj}/{id}', '\App\Http\Controllers\JadwalController@editJadwal')->name('jadwal.editJadwal');
Route::get('/jadwal/update/supervisor/{idj}/{ids}', '\App\Http\Controllers\JadwalController@updateJadwalBySupervisor')->name('jadwal.updateJadwalBySupervisor');
Route::get('/jadwal/index/tim/{idt}', '\App\Http\Controllers\JadwalController@indexTim')->name('jadwal.indexTim');
Route::get('/jadwal/update/tim/{idj}/{idt}', '\App\Http\Controllers\JadwalController@updateJadwalByTim')->name('jadwal.updateJadwalByTim');

Route::get('/progresProjek/supervisor/index/{id}/{idp}', '\App\Http\Controllers\ProgresProjekController@indexSupervisor')->name('progres.indexSupervisor');
Route::get('/progresProjek/tim/index/{id}/{idp}', '\App\Http\Controllers\ProgresProjekController@indexTim')->name('progres.indexTim');
Route::get('/progresProjek/Client/index/{id}/{idp}', '\App\Http\Controllers\ProgresProjekController@indexClient')->name('progres.indexClient');
Route::get('/progresProjek/Admin/index/{idp}', '\App\Http\Controllers\ProgresProjekController@indexAdmin')->name('progres.indexAdmin');

Route::get('/tampilan/admin', '\App\Http\Controllers\LoginController@tampilanAdmin')->name('tampilanAdmin');
Route::get('/tampilan/supervisor/{id}', '\App\Http\Controllers\SupervisorController@tampilanSupervisor')->name('tampilanSupervisor');
Route::get('/tampilan/client/{id}', '\App\Http\Controllers\ClientController@tampilanClient')->name('tampilanClient');
Route::get('/tampilan/tim/{id}', '\App\Http\Controllers\TimController@tampilanTim')->name('tampilanTim');

Route::get('/projek/konfirmasi/{id}/{idp}', '\App\Http\Controllers\ProjekController@konfirmasiProjek')->name('projek.konfirmasiProjek');

Route::get('/evaluasi/index/client/{id}/{idp}', '\App\Http\Controllers\EvaluasiController@indexClient')->name('evaluasi.indexClient');
Route::get('/evaluasi/index/supervisor/{id}/{idp}', '\App\Http\Controllers\EvaluasiController@indexSupervisor')->name('evaluasi.indexSupervisor');
Route::get('/evaluasi/index/tim/{id}/{idp}', '\App\Http\Controllers\EvaluasiController@indexTim')->name('evaluasi.indexTim');
Route::get('/evaluasi/index/admin/{idp}', '\App\Http\Controllers\EvaluasiController@indexAdmin')->name('evaluasi.indexAdmin');
Route::get('/evaluasi/create/{id}/{idp}', '\App\Http\Controllers\EvaluasiController@create')->name('evaluasi.create');
Route::get('/evaluasi/store/{id}/{idp}', '\App\Http\Controllers\EvaluasiController@store')->name('evaluasi.store');

Route::get('/jadwal/pertemuan/supervisor/{ids}', '\App\Http\Controllers\JadwalPertemuanController@indexSupervisor')->name('jadwalPertemuan.indexSupervisor');
Route::get('/jadwal/pertemuan/tim/{idt}', '\App\Http\Controllers\JadwalPertemuanController@indexTim')->name('jadwalPertemuan.indexTim');
Route::get('/jadwal/pertemuan/client/{idc}', '\App\Http\Controllers\JadwalPertemuanController@indexClient')->name('jadwalPertemuan.indexClient');
Route::get('/jadwal/pertemuan/admin', '\App\Http\Controllers\JadwalPertemuanController@indexAdmin')->name('jadwalPertemuan.indexAdmin');
Route::get('/jadwal/pertemuan/store/{ids}', '\App\Http\Controllers\JadwalPertemuanController@store')->name('jadwalPertemuan.store');
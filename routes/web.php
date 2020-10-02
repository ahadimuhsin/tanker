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
    return view('auth/login');
});

Auth::routes();

Route::get('logout', 'Auth\LoginController@logout');
//Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->group(function(){
    Route::get('/home', function () {
        return redirect(route('anggota.index'));
    })->name('home');
    //Route Anggota
    Route::get('get/anggota_tanker', 'AnggotaController@get_anggota_list');
    Route::get('approve_anggota/{no_admin}', 'AnggotaController@acceptAnggota');
    Route::get('reject_anggota/{no_admin}',  'AnggotaController@rejectAnggota');
    Route::resource('anggota', 'AnggotaController');

    //Route Pinjaman
    Route::get('get/pinjaman_tanker', 'PinjamanController@get_pinjaman_list');
    Route::get('get/anggota_pinjaman_by_no_anggota/{no_anggota}', 'PinjamanController@get_anggota_list');
    Route::get('approve_pinjaman/{no_admin}','PinjamanController@acceptPinjaman');
    Route::get('reject_pinjaman/{no_admin}', 'PinjamanController@rejectPinjaman');
    Route::resource('pinjaman', 'PinjamanController');

    //Route Penyertaan
    Route::get('get/anggota_penyertaan_by_no_anggota/{no_anggota}',
        'PenyertaanController@get_anggota_list');
    Route::get('get/penyertaan_tanker', 'PenyertaanController@get_list_penyertaan');
    //approval 1
    Route::get('approve1_penyertaan/{no_admin}','PenyertaanController@acceptPenyertaan1');
    Route::get('reject1_penyertaan/{no_admin}', 'PenyertaanController@rejectPenyertaan1');
    //approval 2
    Route::get('approve2_penyertaan/{no_admin}','PenyertaanController@acceptPenyertaan2');
    Route::get('reject2_penyertaan/{no_admin}', 'PenyertaanController@rejectPenyertaan2');
    Route::resource('penyertaan', 'PenyertaanController');

    //Route Simpanan & SHU
    Route::get('get/anggota_simpanan_by_no_anggota/{no_anggota}', 'SimpananController@get_list_anggota');
    Route::get('get/simpanan_tanker', 'SimpananController@get_list_simpanan_shu');
    Route::get('approve1_simpanan/{no_admin}', 'SimpananController@acceptSimpanan1');
    Route::get('reject1_simpanan/{no_admin}', 'SimpananController@rejectSimpanan1');
    //approval 2
    Route::get('approve2_simpanan/{no_admin}', 'SimpananController@acceptSimpanan2');
    Route::get('reject2_simpanan/{no_admin}', 'SimpananController@rejectSimpanan2');
    Route::resource('simpanan_shu', 'SimpananController');
});

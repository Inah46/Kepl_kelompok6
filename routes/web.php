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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/input', 'Siswa@input')->name('input');

Route::post('/proses', 'Mahasiswa@proses')->name('proses');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/absen', 'HomeController@absen')->name('absen');


// Dosen
Route::get('/dosen/login', 'DosenController@dosenLogin')->name('loginDosen');
Route::post('/dosen/doLogin','DosenController@doLogin')->name('doLoginDosen');

//Admin
Route::get('/admin/login', 'AdminController@adminLogin')->name('loginAdmin');
Route::post('/admin/doLogin','AdminController@doLogin')->name('doLogin');
Route::get('/admin/dashboard', 'AdminController@dashboard')->name('dashboardAdmin');

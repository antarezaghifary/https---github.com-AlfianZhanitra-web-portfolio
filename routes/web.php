<?php

use App\Http\Controllers\Admin\Dashboard;
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
Route::get('/', 'App\Http\Controllers\Home\Homepage@index')->name('homepage');
Route::get('/tentang', 'App\Http\Controllers\Home\Homepage@tentang')->name('tentang');
Route::get('/alat-berat', 'App\Http\Controllers\Home\Homepage@alat_berat')->name('alat_berat');
Route::get('/profil-pengguna', 'App\Http\Controllers\Home\Homepage@profile')->name('profile');
Route::get('/detail-alat-berat/{post}', 'App\Http\Controllers\Home\Homepage@detail')->name('detail');

Route::get('/login', 'App\Http\Controllers\AuthController@index')->name('login');
Route::get('/register', 'App\Http\Controllers\AuthController@register')->name('register');
Route::post('/proses_login', 'App\Http\Controllers\AuthController@proses_login')->name('proses_login');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

Route::get('/dashboard', 'App\Http\Controllers\Admin\Dashboard@index')->name('dashboard')->middleware('cek_login:admin,owner');
Route::get('/profile', 'App\Http\Controllers\Admin\Dashboard@profile')->name('profile')->middleware('cek_login:admin,owner');
Route::put('/update-profile/{post}', 'App\Http\Controllers\Admin\Dashboard@profile_update')->middleware('cek_login:admin,owner');
Route::put('/update-password/{post}', 'App\Http\Controllers\Admin\Dashboard@password_update')->middleware('cek_login:admin,owner');

Route::get('/data-profil-perusahaan', 'App\Http\Controllers\Admin\ProfilPerusahaan@index')->name('profil-perusahaan')->middleware('cek_login:admin,owner');
Route::put('/update-profile-perusahaan/{post}', 'App\Http\Controllers\Admin\ProfilPerusahaan@update')->name('update')->middleware('cek_login:admin,owner');

Route::get('/user/data-admin', 'App\Http\Controllers\Admin\Users@index')->name('admin')->middleware('cek_login:admin,owner');
Route::post('/create-data-user', 'App\Http\Controllers\Admin\Users@create')->name('create')->middleware('cek_login:admin,owner');
Route::put('/update-data-user/{post}', 'App\Http\Controllers\Admin\Users@update')->name('update')->middleware('cek_login:admin,owner');
Route::put('/reset-data-user/{post}', 'App\Http\Controllers\Admin\Users@reset')->name('update')->middleware('cek_login:admin,owner');
Route::delete('/delete-data-user/{post}', 'App\Http\Controllers\Admin\Users@delete')->name('delete')->middleware('cek_login:admin,owner');

Route::get('/user/data-pelanggan', 'App\Http\Controllers\Admin\Pelanggan@index')->name('admin')->middleware('cek_login:admin,owner');
Route::post('/create-data-pelanggan', 'App\Http\Controllers\Admin\Pelanggan@create')->name('create');
Route::put('/update-data-pelanggan/{post}', 'App\Http\Controllers\Admin\Pelanggan@update')->name('update')->middleware('cek_login:admin,owner');
Route::put('/reset-data-pelanggan/{post}', 'App\Http\Controllers\Admin\Pelanggan@reset')->name('update')->middleware('cek_login:admin,owner');
Route::delete('/delete-data-pelanggan/{post}', 'App\Http\Controllers\Admin\Pelanggan@delete')->name('delete')->middleware('cek_login:admin,owner');

Route::get('/data-type', 'App\Http\Controllers\Admin\Type@index')->name('admin')->middleware('cek_login:admin,owner');
Route::post('/create-data-type', 'App\Http\Controllers\Admin\Type@create')->name('create')->middleware('cek_login:admin,owner');
Route::put('/update-data-type/{post}', 'App\Http\Controllers\Admin\Type@update')->name('update')->middleware('cek_login:admin,owner');
Route::delete('/delete-data-type/{post}', 'App\Http\Controllers\Admin\Type@delete')->name('delete')->middleware('cek_login:admin,owner');

Route::get('/data-alat-berat', 'App\Http\Controllers\Admin\AlatBerat@index')->name('admin')->middleware('cek_login:admin,owner');
Route::post('/create-data-alat-berat', 'App\Http\Controllers\Admin\AlatBerat@create')->name('create')->middleware('cek_login:admin,owner');
Route::put('/update-data-alat-berat/{post}', 'App\Http\Controllers\Admin\AlatBerat@update')->name('update')->middleware('cek_login:admin,owner');
Route::delete('/delete-data-alat-berat/{post}', 'App\Http\Controllers\Admin\AlatBerat@delete')->name('delete')->middleware('cek_login:admin,owner');

Route::get('/data-rekening', 'App\Http\Controllers\Admin\Rekening@index')->name('admin')->middleware('cek_login:admin,owner');
Route::post('/create-data-rekening', 'App\Http\Controllers\Admin\Rekening@create')->name('create')->middleware('cek_login:admin,owner');
Route::put('/update-data-rekening/{post}', 'App\Http\Controllers\Admin\Rekening@update')->name('update')->middleware('cek_login:admin,owner');
Route::delete('/delete-data-rekening/{post}', 'App\Http\Controllers\Admin\Rekening@delete')->name('delete')->middleware('cek_login:admin,owner');

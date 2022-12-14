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

Route::get('/', function () {
    return view('welcome');
});



Route::get('login', 'App\Http\Controllers\AuthController@index')->name('login');
Route::post('proses_login', 'App\Http\Controllers\AuthController@proses_login')->name('proses_login');
Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

Route::get('/dashboard', 'App\Http\Controllers\Admin\Dashboard@index')->name('dashboard')->middleware('cek_login:admin,owner');
Route::get('/profile', 'App\Http\Controllers\Admin\Dashboard@profile')->name('profile')->middleware('cek_login:admin,owner');
Route::put('/update-profile/{post}', 'App\Http\Controllers\Admin\Dashboard@profile_update')->middleware('cek_login:admin,owner');
Route::put('/update-password/{post}', 'App\Http\Controllers\Admin\Dashboard@password_update')->middleware('cek_login:admin,owner');

Route::get('/data-profil-perusahaan', 'App\Http\Controllers\Admin\ProfilPerusahaan@index')->name('profil-perusahaan')->middleware('cek_login:admin,owner');
Route::put('/update-profile-perusahaan/{post}', 'App\Http\Controllers\Admin\ProfilPerusahaan@update')->name('update')->middleware('cek_login:admin,owner');


<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\menusidebar;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RekamController;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Route as RoutingRoute;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing-page.landing');
})->name('home');

Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.login');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::get('dashboard', function () {
    return view('admin.dashboard');
});
// Route::get('/data-pasien', function () {
//     return view('data-pasien.data-pasien');
// });

// ->middleware('auth.admin')

Route::get('profile', [Controller::class, 'showProfile'])->name('profile');
Route::get('dashboard', [menusidebar::class, 'dashboard'])->name('dashboard');
Route::get('data-pasien', [menusidebar::class, 'dataPasien'])->name('data-pasien');
Route::get('rekam-medis', [menusidebar::class, 'rekammedis'])->name('rekam-medis');
Route::get('pendaftaran', [menusidebar::class, 'pendaftaran'])->name('pendaftaran');
Route::get('artikel', [menusidebar::class, 'artikel'])->name('artikel');


// Route::group(['middleware' => 'auth.admin'], function () {
//     Route::get('/dashboard', function () {
//         return view('logout');
//     });
// });


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::post('data-pasien/insert', [PasienController::class, 'insert'])->name('insertpasien');
Route::post('data-pasien/delete', [PasienController::class, 'delete'])->name('deletepasien');
Route::post('data-pasien/update', [PasienController::class, 'update'])->name('deleteupdate');
Route::post('rekam-medis/update', [RekamController::class, 'update'])->name('updaterekammedis');
Route::post('rekam-medis/insert', [RekamController::class, 'insert'])->name('insertrekammedis');
Route::post('rekam-medis/delete', [RekamController::class, 'delete'])->name('deleterekammedis');
Route::post('pendaftaran/insert', [PendaftaranController::class, 'insert'])->name('insertpendaftaran');
Route::post('pendaftaran/delete', [PendaftaranController::class, 'delete'])->name('deletependaftaran');
Route::post('pendaftaran/update', [PendaftaranController::class, 'update'])->name('updatependaftaran');
Route::post('artikel/update', [ArtikelController::class, 'update'])->name('updateartikel');
Route::post('artikel/insert', [ArtikelController::class, 'insert'])->name('insertartikel');
Route::post('artikel/delete', [ArtikelController::class, 'delete'])->name('deleteartikel');

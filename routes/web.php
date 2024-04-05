<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\menusidebar;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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
    return view('Landing page.landing');
})->name('home');

Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.login');
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
Route::get('data-pegawai', [menusidebar::class, 'datapegawai'])->name('data-pegawai');
Route::get('rekam-medik', [menusidebar::class, 'rekammedik'])->name('rekam-medik');
Route::get('antrian', [menusidebar::class, 'antrian'])->name('antrian');
Route::get('artikel', [menusidebar::class, 'artikel'])->name('artikel');


// Route::group(['middleware' => 'auth.admin'], function () {
//     Route::get('/dashboard', function () {
//         return view('logout');
//     });
// });


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::post('data-pasien/insert',[PasienController::class, 'insert'])->name('insertpasien');
Route::post('data-pasien/delete', [PasienController::class, 'delete'])->name('deletepasien');
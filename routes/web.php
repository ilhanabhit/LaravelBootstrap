<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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
    return view('home');
})->name('home');

Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('dashboard', function () {
    return view('logout');
})->middleware('auth.admin'); // Sesuaikan middleware dengan yang dibutuhkan

Route::group(['middleware' => 'auth.admin'], function () {
    Route::get('/dashboard', function () {
        return view('logout');
    });
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

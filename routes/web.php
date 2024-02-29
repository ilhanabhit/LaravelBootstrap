<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
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
    return view('Landing page.landing');
})->name('home');

Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.login');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('dashboard', function () {
    return view('admin.dashboard');
});
// ->middleware('auth.admin')

Route::get('profile', [Controller::class, 'showProfile'])->name('profile');
// Route::group(['middleware' => 'auth.admin'], function () {
//     Route::get('/dashboard', function () {
//         return view('logout');
//     });
// });


Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
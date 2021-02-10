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

//Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RegisterController;

Route::get('/', function (){
   return redirect()->route('dashboard');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login/user', [LoginController::class, 'doLogin'])->name('login.user');
Route::get('/logout/user', [LoginController::class, 'logout'])->name('logout.user');



Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::group(['prefix' => 'admin', 'middleware' => ['role:superadministrator']], function() {
    Route::get('/register/user', [RegisterController::class, 'index'])->name('register.page');
    Route::post('/register/user', [RegisterController::class, 'register'])->name('register.user');
});

//Route::group(['middleware' => ['auth']], function () {
//    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//    Route::get('/register/user', [RegisterController::class, 'index'])->name('register.page');
//    Route::post('/register/user', [RegisterController::class, 'register'])->name('register.user');
//});
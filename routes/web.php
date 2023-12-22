<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
});
Route::get('/register', [LoginRegisterController::class, 'register'])->name('register');

Route::post('/store', [LoginRegisterController::class, 'store'])->name('store');

Route::get('/login', [LoginRegisterController::class, 'login'])->name('login');

Route::post('/loginUserAdmin', [LoginRegisterController::class, 'loginUserAdmin'])->name('loginUserAdmin');

Route::group(['middleware' => ['auth', 'isAdmin']], function () {

    Route::get('/AuthDashboard', [LoginRegisterController::class, 'AuthDashboard'])->name('AuthDashboard');
});

Route::get('/dashboard', [LoginRegisterController::class, 'dashboard'])->name('dashboard');

Route::get('/logout', [LoginRegisterController::class, 'logout'])->name('logout');

Route::get('/userViewInformation', [LoginRegisterController::class, 'userViewInformation'])->name('userViewInformation');

Route::get('/userInformation', [LoginRegisterController::class, 'userInformation'])->name('userInformation');

Route::get('/deleteUserByAdmin/{id}', [LoginRegisterController::class, 'deleteUserByAdmin'])->name('deleteUserByAdmin');

Route::get('/deleteUserByUser', [LoginRegisterController::class, 'deleteUserByUser'])->name('deleteUserByUser');

Route::get('/userInformation', [LoginRegisterController::class, 'userInformation'])->name('userInformation');

Route::get('/userInformation', [LoginRegisterController::class, 'userInformation'])->name('userInformation');

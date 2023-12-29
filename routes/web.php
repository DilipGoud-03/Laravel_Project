<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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


Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/loginRequest', 'loginRequest')->name('loginRequest');
    Route::get('/logout', 'logout')->name('logout');
});

Route::middleware(['is_admin'])->group(function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('/adminDashboard', 'dashboard')->name('adminDashboard');

        Route::get('/deleteUserByAdmin/{id}', 'deleteUserByAdmin')->name('deleteUserByAdmin');
        Route::get('/userInformationByAdmin', 'userInformationByAdmin')->name('userInformationByAdmin');
        Route::get('/updateUserIndex/{id}', 'updateUserIndex')->name('updateUserIndex');
        Route::post('/saveUpdate/{id}', 'saveUpdate')->name('saveUpdate');

        Route::get('/updateUserRoleIndex/{id}', 'updateUserRoleIndex')->name('updateUserRoleIndex');
        Route::post('/saveUpdateUserRole/{id}', 'saveUpdateUserRole')->name('saveUpdateUserRole');
    });
});
Route::middleware(['is_user'])->group(function () {

    Route::controller(UserController::class)->group(function () {
        Route::get('/userDashboard', 'userDashboard')->name('userDashboard');

        Route::get('/deleteUserByUser/{id}', 'deleteUserByUser')->name('deleteUserByUser');
        Route::get('/userViewInformation', 'userViewInformation')->name('userInformation');
        Route::get('/update/{id}', 'update')->name('update');
        Route::post('/storeUpdateUser/{id}', 'storeUpdateUser')->name('storeUpdateUser');
    });
});

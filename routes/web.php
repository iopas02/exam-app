<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SuperadminController;

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
    return view('index');
})->name('index');

Route::controller(UserController::class)->name('user.')->group(function(){
    Route::middleware('guest')->group(function(){
        Route::get('/login', 'login')->name('login');
        Route::post('/login-post', 'loginPost')->name('loginPost');
    });
    Route::middleware('auth')->group(function(){
        Route::get('/home', 'home')->name('home');
        Route::get('/logout', 'logout')->name('logout');
    });
});
Route::middleware('auth')->group(function(){
    Route::controller(SuperadminController::class)->name('superadmin.')->group(function(){
        Route::get('/superadmin/home', 'home')->name('home');
        Route::get('/superadmin/register', 'register')->name('register');
        Route::post('/superadmin/register-post', 'registerPost')->name('registerPost');
    });

    Route::controller(ClientController::class)->name('client.')->group(function(){
        Route::get('/client/home', 'home')->name('home');
        Route::get('/client/request/{item}', 'request')->name('request');
        Route::post('/client/request/{item}/post', 'requestPost')->name('requestPost');
    });

    Route::controller(AdminController::class)->name('admins.')->group(function(){
        Route::post('/admin/approve', 'approve')->name('approve');
        Route::post('/admin/reject', 'reject')->name('reject');
    });

    Route::resource('admin', AdminController::class);
});

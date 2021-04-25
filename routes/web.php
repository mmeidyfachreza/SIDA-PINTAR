<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;
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
    return redirect()->route('admin.login');
});

Auth::routes();

Route::get('/admin/login', [AdminLoginController::class,'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class,'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminLoginController::class,'login'])->name('admin.logout');
//Admin Home page after login
Route::group(['middleware'=>'admin'], function() {
    Route::get('/admin/home', [HomeController::class,'index'])->name('admin.home');
    Route::post('/admin/cari-siswa', [HomeController::class,'searchStudent'])->name('search.student');
    Route::resource('siswa', StudentController::class);
    Route::get('/admin/download-file/{type}/name/{name}', [HomeController::class,'downloadFile'])->name('admin.download');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

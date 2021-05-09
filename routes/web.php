<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
})->name('welcome');

Route::get('guest/siswa', function () {
    return view('student');
})->name('student');

Route::post('guest/siswa/pencarian', [GuestController::class,'search'])->name('search');

Route::get('/tes', function () {
    return Storage::download("public/avatars/default.jpg");
});

Auth::routes();

Route::get('/admin/login', [AdminLoginController::class,'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class,'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminLoginController::class,'logout'])->name('admin.logout');
//Admin Home page after login
Route::group(['middleware'=>'auth:web,admin'], function() {
    Route::get('/admin/home', [HomeController::class,'index'])->name('admin.home');
    Route::post('/admin/cari-siswa', [HomeController::class,'searchStudent'])->name('search.student');
    Route::resource('siswa', StudentController::class)->except('show');
    Route::get('/siswa/detail/{id}', [StudentController::class,'show'])->name('siswa.show');
    Route::get('/siswa-sd', [StudentController::class,'indexSd'])->name('student.sd');
    Route::get('/siswa-smp', [StudentController::class,'indexSmp'])->name('student.smp');
    Route::get('/admin/download-file/{type}/name/{name}', [HomeController::class,'downloadFile'])->name('admin.download');
    Route::get('surat-keterangan/{id}', [StudentController::class,'statementLetter'])->name('statement_letter');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

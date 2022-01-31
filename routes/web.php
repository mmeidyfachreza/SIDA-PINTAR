<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
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
    return redirect()->route('admin.home');
})->name('welcome');

Route::get('guest/siswa', function () {
    return view('student');
})->name('student');

Route::post('guest/siswa/pencarian', [GuestController::class,'search'])->name('search');

Route::get('/tes', function () {
    //Artisan::call('migrate:fresh --seed');
    return view("letter.letter_format");
});

// Route::get('/maintenance', function () {
//     Artisan::call('down --secret="ag2Vk5hfUfVfJfhBvvWz"');
//     return "maintenance on";
// });

// Route::get('/up', function () {
//     Artisan::call('up');
//     return "maintenance off";
// });

Auth::routes();

Route::get('/admin/login', [AdminLoginController::class,'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class,'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminLoginController::class,'logout'])->name('admin.logout');
Route::get('/admin/reload-captcha', [AdminLoginController::class, 'reloadCaptcha']);
Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha']);
//Admin Home page after login
Route::group(['middleware'=>'auth:web,admin'], function() {
    Route::get('/admin/home', [HomeController::class,'index'])->name('admin.home');
    Route::post('/admin/cari-siswa', [HomeController::class,'searchStudent'])->name('dashboard.search');
    Route::resource('siswa', StudentController::class);
    Route::post('/siswa/cari', [StudentController::class,'searchStudent'])->name('search.student');
    Route::resource('akun-sekolah', UserController::class);
    Route::resource('sekolah', SchoolController::class);
    Route::post('siswa-import', [StudentController::class,'studentImport'])->name('student.import');
    Route::post('siswa-update-import', [StudentController::class,'studentUpdateImport'])->name('student.import.update');
    Route::get('format-export-siswa', [StudentController::class,'studentExportFormat'])->name('student.format.export');
    Route::get('/siswa-sd', [StudentController::class,'indexSd'])->name('student.sd');
    Route::get('/siswa-smp', [StudentController::class,'indexSmp'])->name('student.smp');
    Route::get('/admin/download-file/{type}/name/{name}', [HomeController::class,'downloadFile'])->name('admin.download');
    Route::get('surat-keterangan/{id}', [StudentController::class,'statementLetter'])->name('statement_letter');
    Route::get('format-surat-keterangan/{id}', [HomeController::class,'downloadLetter'])->name('statement_letter2');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

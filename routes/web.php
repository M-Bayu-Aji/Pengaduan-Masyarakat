<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StaffProvinceController;
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
    return view('welcome', [
        'title' => 'Welcome'
    ]);
})->name('welcome');

Route::middleware(['IsLogout'])->group(function () {
    Route::name('proses.')->prefix('proses')->group(function () {
        Route::get('/register', [LoginController::class, 'indexRegister'])->name('register');
        Route::post('/register-proses', [LoginController::class, 'store'])->name('register.success');
        Route::get('/login', [LoginController::class, 'index'])->name('login');
        Route::post('/login-proses', [LoginController::class, 'authenticate'])->name('login.success');
    });
});

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['IsLogin'])->group(function () {
    Route::name('report.')->prefix('report')->group(function () {
        Route::get('/create', [ReportController::class, 'index'])->name('create');
        Route::post('/proses', [ReportController::class, 'store'])->name('proses');
        Route::get('/report-user', [ReportController::class, 'show'])->name('user');
        Route::get('/report-user-me', [ReportController::class, 'reportUser'])->name('you');
        Route::delete('/hapus-product/{id}', [ReportController::class, 'destroy'])->name('delete');
        Route::get('report/{id}', [ReportController::class, 'comment'])->name('comment');
        Route::post('/comment', [ReportController::class, 'commentProses'])->name('comment_proses');
        Route::get('/vote/{id}', [ReportController::class, 'voteReport'])->name('vote');
    });
});

Route::middleware(['IsStaff'])->group(function () {
    Route::name('staff.')->prefix('staff')->group(function () {
        Route::get('report', [StaffProvinceController::class, 'index'])->name('report');
    });
});

Route::middleware(['IsHeadStaff'])->group(function () {
    Route::name('head.staff.')->prefix('head-staff')->group(function () {
        Route::get('report', [StaffProvinceController::class, 'index'])->name('report');
        Route::get('create-account', [StaffProvinceController::class, 'createAccount'])->name('account');
        Route::post('create-account-proses', [StaffProvinceController::class, 'store'])->name('create.acc');
        Route::delete('delete-account/{id}', [StaffProvinceController::class, 'destroy'])->name('delete');
    });
});

Route::get('article', [LoginController::class, 'welcomeArticle'])->name('welcome_article');
Route::post('/report/increment-viewers/{id}', [ReportController::class, 'viewers'])->name('increment.viewers');
Route::get('/reports/search', [ReportController::class, 'search'])->name('reports.search');

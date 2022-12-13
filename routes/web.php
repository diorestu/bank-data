<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyDashboard\CompanyLowonganController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\UserDashboard\UserDashboardController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cari', [HomeController::class, 'viewCari'])->name('app.viewCari');
Route::post('/cari', [HomeController::class, 'sendCari'])->name('app.postCari');
Route::get('/layanan/kategori', [HomeController::class, 'l1'])->name('app.l1');
Route::get('/layanan/gaji', [HomeController::class, 'l2'])->name('app.l2');
Route::get('/layanan/perusahaan', [HomeController::class, 'l3'])->name('app.l3');


Route::middleware('auth')->group(function () {
    // Halaman Global
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('profile', [ProfileController::class, 'userShow'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    // Halaman User
    Route::middleware(['is_user'])->group(function () {
        Route::resource('/resume', ResumeController::class);
        Route::get('/lamaran', [UserDashboardController::class, 'lamaranSaya'])->name('user.lamaran');
    });

    // Halaman Admin
    Route::middleware(['is_admin'])->prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.home');
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('profile', [ProfileController::class, 'show'])->name('admin.profile.show');
        Route::put('profile', [ProfileController::class, 'update'])->name('admin.profile.update');

        Route::post('kandidat/interview/{id}', [LeadController::class, 'intLead'])->name('kandidat.interview');
        Route::post('kandidat/approve/{id}', [LeadController::class, 'apprLead'])->name('kandidat.approve');
        Route::get('kandidat/print/{id}', [LeadController::class, 'print'])->name('kandidat.print');
        Route::resource('kandidat', LeadController::class);

        Route::resource('kategori', CategoryController::class);
        Route::resource('mitra', LocationController::class);
    });

    // Halaman Perusahaan
    Route::middleware(['is_company'])->prefix('perusahaan')->group(function () {
        Route::get('/', [PerusahaanController::class, 'dashboard'])->name('company.dashboard');
        Route::resource('lowongan', CompanyLowonganController::class);
        Route::get('/pasang-lowongan', [HomeController::class, 'postJob'])->name('app.postJob');
    });
});

Auth::routes();

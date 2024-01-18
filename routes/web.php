<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\UserApplicationController;
use App\Http\Controllers\OpdController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\User\GeneralUserController;


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


Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('auth.login2');
    })->name('/');
    Route::post('login', [AuthenticationController::class, 'index'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
    Route::get('cek_email_all/{email}', [AuthenticationController::class, 'cek_email_all'])->name('cek_email_all');
    Route::get('cek_email_profile/{email}', [AuthenticationController::class, 'cek_email_profile'])->name('cek_email_profile');

    // dashboard
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('/');
        // Route::get('/', [DashboardController::class, 'index'])->name('/');

        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name('/');

            // user akun all
            Route::get('list_akun', [UserController::class, 'index'])->name('list_akun');
            Route::post('list_akun', [UserController::class, 'create_akun'])->name('create_akun');
            Route::get('detail_akun/{email}', [UserController::class, 'show_akun'])->name('detail_akun');
            Route::get('edit_akun/{email}', [UserController::class, 'edit_akun'])->name('edit_akun');
            Route::put('update_akun/{email}', [UserController::class, 'update_akun'])->name('update_akun');
            Route::delete('hapus_akun/{email}', [UserController::class, 'hapus_akun'])->name('hapus_akun');

            // aplikasi
            Route::get('aplikasi', [ApplicationController::class, 'index'])->name('aplikasi');
            Route::post('aplikasi', [ApplicationController::class, 'create_app'])->name('aplikasi');
            Route::get('user_akun/{id_applications}', [ApplicationController::class, 'user_akun'])->name('user_akun');
            Route::delete('hapus_akun_app/{email}/{id_applications}', [UserApplicationController::class, 'hapus_akun_app'])->name('hapus_akun_app');
            Route::get('halaman_tambah_akun_app/{id_applications}', [UserApplicationController::class, 'hal_tambah_akun_app'])->name('halaman_tambah_akun_app');
            Route::post('tambah_akun_app', [UserApplicationController::class, 'tambah_akun_app'])->name('tambah_akun_app');
            Route::get('edit_app/{id_applications}', [ApplicationController::class, 'edit_app'])->name('edit_app');
            Route::post('update_app/{id_applications}', [ApplicationController::class, 'update_app'])->name('update_app');
            Route::delete('delete_app/{id_applications}', [ApplicationController::class, 'delete_app'])->name('delete_app');

            // opd
            Route::get('opd', [OpdController::class, 'index'])->name('opd');
            Route::post('opd', [OpdController::class, 'create_opd'])->name('opd');
            Route::get('edit_opd/{id_opds}', [OpdController::class, 'edit_opd'])->name('edit_opd');
            Route::post('update_opd/{id_opds}', [OpdController::class, 'update_opd'])->name('update_opd');
            Route::delete('delete_opd/{id_opds}', [OpdController::class, 'delete_opd'])->name('delete_opd');
            Route::get('user_opd/{id_opds}', [OpdController::class, 'get_user_opd'])->name('user_opd');


            // profile
            Route::get('profile', [ProfileController::class, 'index'])->name('profile');
            Route::get('edit_profile', [ProfileController::class, 'edit_profile'])->name('edit_profile');
            Route::put('update_profile/{email}', [ProfileController::class, 'update_profile'])->name('update_profile');

            // Route::get('/tes', function () {
            //     return view('admin.opd.edit_opd');
            // });

        });

        Route::prefix('user')->name('user.')->group(function () {
            // profile
            Route::get('/', [GeneralUserController::class, 'index'])->name('/');

            Route::get('profile', [GeneralUserController::class, 'profile'])->name('profile');
            Route::get('edit_profile', [GeneralUserController::class, 'edit_profile'])->name('edit_profile');
            Route::put('update_profile/{email}', [GeneralUserController::class, 'update_profile'])->name('update_profile');
        });
    });
});

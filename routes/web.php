<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\GajiController;
use App\Http\Controllers\Admin\TunjanganController;
use App\Http\Controllers\Admin\KehadiranController;
use App\Http\Controllers\Admin\HutangController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AngsuranController;

use App\Http\Controllers\UserController;
use App\Models\Jabatan;

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
// Routes User

// Routes Admin
Route::get('/', [LoginController::class, 'index'])->name('admin.login');
Route::post('admin/login', [LoginController::class, 'authenticate'])->name(
    'admin.login.auth'
);

Route::group(
    ['prefix' => 'admin', 'middleware' => ['admin.auth']],
    function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name(
            'admin.dashboard'
        );
        Route::get('logout', [LoginController::class, 'logout'])->name(
            'admin.logout'
        );
        Route::resource('karyawan', KaryawanController::class);
        Route::resource('gaji', GajiController::class);
        Route::get('gaji/{id}/print', [GajiController::class, 'print'])->name(
            'gaji.print'
        );

        Route::resource('tunjangan', TunjanganController::class);
        Route::resource('hutang', HutangController::class);
        Route::resource('kehadiran', KehadiranController::class);
        Route::resource('angsuran', AngsuranController::class);

        Route::post('add-user', [KaryawanController::class, 'addUserEmployee'])->name('add.users');
        Route::put('update-user/{id}', [KaryawanController::class, 'updateUserEmployee'])->name('update.users');

        Route::post('presensi-masuk', [KehadiranController::class, 'presensiMasuk'])->name('presensi.masuk');
        Route::post('presensi-pulang', [KehadiranController::class, 'presensiPulang'])->name('presensi.pulang');

        Route::get('ajaxShowEmployee/{id}', [KaryawanController::class, 'showEmployee'])->name('ajaxShowEmployee');
    }
);
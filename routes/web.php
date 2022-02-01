<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\MkuliahController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\KelasAdminController;
use App\Http\Controllers\KelasDosenController;
use App\Http\Controllers\KelasMhsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AbsensiDosenController;
use App\Http\Controllers\AbsensiMhsController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UsersExportController;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('user', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('posts', PostController::class);
    Route::resource('absensiDosen', AbsensiDosenController::class);
    Route::resource('absensiMhs', AbsensiMhsController::class);
    Route::resource('mkuliah', MkuliahController::class);
    Route::resource('dashboardAdmin', DashboardAdminController::class);
    Route::resource('dashboard', DashboardController::class);
    Route::resource('rekap', RekapController::class);
    Route::resource('riwayat', RiwayatController::class);
    Route::resource('kelasAdmin', KelasAdminController::class);
    Route::resource('kelasDosen', KelasDosenController::class);
    Route::resource('kelasMhs', KelasMhsController::class);
    Route::resource('pass', PasswordController::class);

    Route::post('/destroyKelas', 'App\Http\Controllers\kelasMhsController@destroyKelas')-> name('kelasMhs.destroyKelas');
    Route::post('/tambahInfoKelas', 'App\Http\Controllers\kelasDosenController@tambahInfo')-> name('kelasDosen.tambahInfoKelas');
    Route::post('/bukaAbsen', 'App\Http\Controllers\kelasDosenController@bukaAbsensi')-> name('kelasDosen.bukaAbsen');
    Route::get('/getDosen{id}','App\Http\Controllers\MkuliahController@getDosenByIdmk')-> name('/getDosen{id}');
    Route::get('/users/export', [UsersExportController::class, 'export'])->name('users.export');
});

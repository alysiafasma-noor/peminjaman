<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ReturnMonitoringController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('actionLogin');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/', function () {
    return redirect()->route(Auth::check() ? 'dashboard' : 'login');
});

Route::middleware(['auth', 'role.access:dashboard'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth', 'role.access:log_aktivitas'])->get('/log-aktivitas', [ActivityLogController::class, 'index'])->name('log.aktivitas');
Route::middleware(['auth', 'role.access:laporan'])->get('/laporan', [ActivityLogController::class, 'report'])->name('laporan');
Route::middleware(['auth', 'role.access:approval'])->get('/approval', [ApprovalController::class, 'index'])->name('approval.index');
Route::middleware(['auth', 'role.access:approval'])->post('/approval/{id}/approve', [ApprovalController::class, 'approve'])->name('approval.approve');
Route::middleware(['auth', 'role.access:approval'])->post('/approval/{id}/reject', [ApprovalController::class, 'reject'])->name('approval.reject');
Route::middleware(['auth', 'role.access:return_monitoring'])->get('/pengembalian', [ReturnMonitoringController::class, 'index'])->name('return-monitoring.index');
Route::middleware(['auth', 'role.access:return_monitoring_saya'])->get('/pengembalian/saya', [ReturnMonitoringController::class, 'saya'])->name('return-monitoring.saya');
Route::middleware(['auth', 'role.access:return_monitoring'])->post('/pengembalian/{id}/kembalikan', [ReturnMonitoringController::class, 'kembali'])->name('return-monitoring.kembali');

Route::middleware('auth')->get('/profil', function () {
    return view('home.profil', ['user' => Auth::user()]);
})->name('profil');

Route::middleware('role.access:user')->group(function () {
    Route::get('/user', [UserController::class,'index'])->name('user.index');
    Route::get('/user/create', [UserController::class,'create'])->name('user.create');
    Route::get('/user/edit/{id}', [UserController::class,'edit'])->name('user.edit');
    Route::get('/user/destroy/{id}', [UserController::class,'destroy'])->name('user.destroy');
    Route::post('/user/store', [UserController::class,'store'])->name('user.store');
    Route::post('/user/update/{id}', [UserController::class,'update'])->name('user.update');
});

Route::middleware('role.access:kategori')->group(function () {
    Route::get('/kategori', [KategoriController::class,'index'])->name('kategori.index');
    Route::get('/kategori/create', [KategoriController::class,'create'])->name('kategori.create');
    Route::get('/kategori/edit/{id}', [KategoriController::class,'edit'])->name('kategori.edit');
    Route::get('/kategori/destroy/{id}', [KategoriController::class,'destroy'])->name('kategori.destroy');
    Route::post('/kategori/store', [KategoriController::class,'store'])->name('kategori.store');
    Route::post('/kategori/update/{id}', [KategoriController::class,'update'])->name('kategori.update');
});

Route::middleware('role.access:alat')->group(function () {
    Route::get('/alat', [AlatController::class,'index'])->name('alat.index');
    Route::get('/alat/create', [AlatController::class,'create'])->name('alat.create');
    Route::get('/alat/edit/{id}', [AlatController::class,'edit'])->name('alat.edit');
    Route::get('/alat/destroy/{id}', [AlatController::class,'destroy'])->name('alat.destroy');
    Route::post('/alat/store', [AlatController::class,'store'])->name('alat.store');
    Route::post('/alat/update/{id}', [AlatController::class,'update'])->name('alat.update');
});

Route::middleware(['auth', 'role.access:alat_daftar'])->get('/alat/lihat', [AlatController::class,'daftar'])->name('alat.daftar');

Route::middleware('role.access:peminjaman')->group(function () {
    Route::get('/peminjaman', [PeminjamanController::class,'index'])->name('peminjaman.index');
    Route::get('/peminjaman/create', [PeminjamanController::class,'create'])->name('peminjaman.create');
    Route::get('/peminjaman/edit/{id}', [PeminjamanController::class,'edit'])->name('peminjaman.edit');
    Route::get('/peminjaman/destroy/{id}', [PeminjamanController::class,'destroy'])->name('peminjaman.destroy');
    Route::post('/peminjaman/store', [PeminjamanController::class,'store'])->name('peminjaman.store');
    Route::post('/peminjaman/update/{id}', [PeminjamanController::class,'update'])->name('peminjaman.update');
});

Route::middleware(['auth', 'role.access:peminjaman_ajukan'])->get('/peminjaman/ajukan', [PeminjamanController::class,'ajukan'])->name('peminjaman.ajukan');
Route::middleware(['auth', 'role.access:peminjaman_ajukan'])->post('/peminjaman/ajukan', [PeminjamanController::class,'submitAjukan'])->name('peminjaman.submit');

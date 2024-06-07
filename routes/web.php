<?php

use App\Http\Controllers\back\AuthController;
use App\Http\Controllers\back\DashboardController;
use App\Http\Controllers\back\hargacontroller;
use App\Http\Controllers\back\jenisSampahController;
use App\Http\Controllers\back\kategoriController;
use App\Http\Controllers\back\settingController;
use App\Http\Controllers\back\UserController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Route::middleware(['guest'])->group(function(){
    Route::get('/login', [AuthController::class, 'index'])->name('login'); 
    Route::post('/login', [AuthController::class, 'login'] );     
});

Route::middleware(['auth'])->group(function(){

    //dashboard
    Route::get('/banksampah', [DashboardController::class, 'index']);
    Route::get('/banksampah/admin', [DashboardController::class, 'admin'])->name('admin.index')->middleware('userAkses:admin');
    Route::get('/banksampah/petugas', [DashboardController::class, 'petugas'])->name('petugas.index')->middleware('userAkses:petugas');
    Route::get('/banksampah/pengguna', [DashboardController::class, 'supervisor'])->name('supervisor.index')->middleware('userAkses:supervisor');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
 

    //user
    Route::get('/user', [UserController::class, 'index'])->name('users.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('users.tambah');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/user/store', [UserController::class, 'store'])->name('users.store');
    Route::post('/user/update/{id}', [UserController::class, 'update'])->name('users.update');

    //profile
    Route::get('/profile/{id}', [UserController::class, 'profile'])->name('profile');

    //setting
    Route::get('/setting', [settingController::class, 'index'])->name('setting.index');
    Route::post('/setting/store', [settingController::class, 'store'])->name('setting.store');
    Route::post('/setting/update{id}', [settingController::class, 'update'])->name('setting.update');


    //kategori sampah
    Route::get('/kategori', [kategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [kategoriController::class, 'create'])->name('kategori.tambah');
    Route::get('/kategori/edit/{id_kategori}', [kategoriController::class, 'edit'])->name('kategori.edit');
    Route::post('/kategori/store', [kategoriController::class, 'store'])->name('kategori.store');
    Route::post('/kategori/update/{id_kategori}', [kategoriController::class, 'update'])->name('kategori.update');
    Route::post('/kategori/delete/', [kategoriController::class, 'delete'])->name('kategori.delete');

    //jenis sampah
    Route::get('/jenis', [jenisSampahController::class, 'index'])->name('jenis.index');
    Route::get('/jenis/create', [jenisSampahController::class, 'create'])->name('jenis.tambah');
    Route::get('/jenis/edit/{id_kategori}', [jenisSampahController::class, 'edit'])->name('jenis.edit');
    Route::post('/jenis/store', [jenisSampahController::class, 'store'])->name('jenis.store');
    Route::post('/jenis/update/{id_kategori}', [jenisSampahController::class, 'update'])->name('jenis.update');
    Route::post('/jenis/delete/', [jenisSampahController::class, 'delete'])->name('jenis.delete');
});


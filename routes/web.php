<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
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

//Tampilan Home
Route::get('/', [HomeController::class, 'buku']);
Route::get('search', [HomeController::class, 'search'])->name('search');
Route::patch('buku/{b}/buy', [HomeController::class, 'buy'])->name('buku.buy');

//Tampilan Admin
// buku
Route::get('admin', [AdminController::class, 'bukuAdmin'])->name('buku.admin');
Route::get('bukutambah', [AdminController::class, 'create'])->name('buku.tambah');
Route::post('bukutambah', [AdminController::class, 'store']);
Route::delete('admin/{buku}', [AdminController::class, 'destroy'])->name('admin.destroy');
Route::get('admin/{id}', [AdminController::class, 'edit'])->name('buku.edit');
Route::put('admin/{id}', [AdminController::class, 'update']);
Route::get('searchAdmin', [AdminController::class, 'searchAdmin'])->name('searchAdmin');
// penerbit
Route::get('searchPenerbit', [AdminController::class, 'searchPenerbit'])->name('searchPenerbit');
Route::get('penerbit', [AdminController::class, 'penerbitAdmin'])->name('penerbit.admin');
Route::get('penerbittambah', [AdminController::class, 'tambah']);
Route::post('penerbittambah', [AdminController::class, 'tambahsimpan']);
Route::delete('penerbit/{penerbit}', [AdminController::class, 'destroypenerbit'])->name('penerbit.destroy');
Route::get('penerbit/{id}', [AdminController::class, 'editpenerbit'])->name('penerbit.edit');
Route::put('penerbit/{id}', [AdminController::class, 'updatepenerbit']);

//Tampilan Pengadaan
Route::get('searchPengadaan', [AdminController::class, 'searchPengadaan'])->name('searchPengadaan');
Route::get('pengadaan', [AdminController::class, 'pengadaan'])->name('pengadaaan.admin');



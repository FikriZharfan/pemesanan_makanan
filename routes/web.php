<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\MakananBeratController;
use App\Http\Controllers\MinumanController;
use App\Http\Controllers\MakananKecilController;

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

// Redirect dari / dengan bangku param ke welcome dengan bangku
Route::get('/bangku', function () {
    $bangku = request('bangku') ?? request()->query('bangku');
    if ($bangku) {
        return redirect('/?' . http_build_query(['bangku' => $bangku]));
    }
    return redirect('/');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes([
    'register' => false // menonaktifkan register
]);
// Pastikan route POST untuk login tersedia (form mengirim POST ke /login)
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.post');
Route::get('/makanan_berat', [MakananBeratController::class, 'index'])->name('makanan_berat');

Route::get('/minuman', [MinumanController::class, 'index'])->name('minuman');

Route::get('/makanan_kecil', [MakananKecilController::class, 'index'])->name('makanan_kecil');

Route::post('/pesan', [PesanController::class, 'store'])->name('pesan.store');
Route::post('/pesanan/{id}/status', [PesanController::class, 'changeStatus'])->name('pesanan.status');
Route::get('/pemesanan', function () {
    $pesanans = \App\Models\Pemesanan::latest()->get();
    return view('pemesanan', compact('pesanans'));
})->name('pemesanan');
Route::get('/pesanan/{id}/edit', [PesanController::class, 'edit'])->name('pesanan.edit');
Route::put('/pesanan/{id}', [PesanController::class, 'update'])->name('pesanan.update');
Route::delete('/pesanan/{id}', [PesanController::class, 'destroy'])->name('pesanan.destroy');
Route::get('/pemesanan/cetak', [PesanController::class, 'cetak'])->name('pemesanan.cetak');
Route::resource('produk', ProdukController::class);

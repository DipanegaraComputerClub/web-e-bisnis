<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class,'index'])->name('login');
Route::get('register', [AuthController::class,'register'])->name('register');
Route::post('proses_login', [AuthController::class,'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class,'logout'])->name('logout');
Route::post('proses_register',[AuthController::class,'proses_register'])->name('proses_register');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cek_login:admin']], function () {
        // Route::resource('admin', AdminController::class);
        Route::get('/admin', [AdminController::class, 'index'])->name('ahome');
        Route::get('/admin/produk', [AdminController::class, 'produk'])->name('aproduk');
        Route::get('/admin/user', [AdminController::class, 'user'])->name('auser');
        Route::get('/admin/pesanan', [AdminController::class, 'pesanan'])->name('apesanan');
        Route::get('/admin/konfirmasi', [AdminController::class, 'konfirmasi'])->name('akonfirmasi');
        Route::get('/admin/tambah-produk', [AdminController::class, 'tproduk'])->name('tproduk');
        Route::post('/admin/products', [AdminController::class, 'proproduk'])->name('storeProduct');
        Route::get('/admin/products/{id}/edit', [AdminController::class, 'editProduct'])->name('editProduct');
        Route::put('/admin/products/{id}', [AdminController::class, 'updateProduct'])->name('updateProduct');
        Route::delete('/admin/products/{id}', [AdminController::class, 'deleteProduct'])->name('deleteProduct');
        Route::delete('/admin/user/{id}', [AdminController::class, 'deleteuser'])->name('deleteuser');
        Route::delete('/admin/pesanan/{id}', [AdminController::class, 'deletepesanan'])->name('deletepesanan');
        Route::post('/admin/konfirmasi/accept/{id}', [AdminController::class, 'acceptKonfirmasi'])->name('acceptKonfirmasi');
        Route::post('/admin/konfirmasi/reject/{id}', [AdminController::class, 'rejectKonfirmasi'])->name('rejectKonfirmasi');
    });
    Route::group(['middleware' => ['cek_login:user']], function () {
        Route::get('/dashboard', [UserController::class, 'index'])->name('home');
        Route::get('/keranjang', [UserController::class, 'keranjang'])->name('keranjang');
        Route::post('/mkeranjang/{id}', [UserController::class, 'masukkeranjang'])->name('masukkeranjang');
        Route::get('/hapuskeranjang/{id}', [UserController::class, 'hapuskeranjang'])->name('hapusker');
        Route::post('/proses-beli', [UserController::class, 'prosesBeli'])->name('proses.beli');
        Route::get('/detail/{id}', [UserController::class, 'detail'])->name('detail');
        Route::get('/tutorial', [UserController::class, 'tutorial'])->name('tutorial');
        Route::get('/pesanan', [UserController::class, 'pesanan'])->name('pesanan');
        Route::get('/hpes/{id}', [UserController::class, 'hpes'])->name('hpes');
        Route::get('/konfirmasii/{id}', [UserController::class, 'konfirmasii'])->name('konfirmasii');
        Route::post('/upload/{id}', [UserController::class, 'upload'])->name('upload');
        Route::get('/wishlist', [UserController::class, 'wishlist'])->name('wishlist');
        Route::get('/beli/{id}', [UserController::class, 'beli'])->name('beli');
        Route::get('/search', [UserController::class, 'search'])->name('search');
    });
});

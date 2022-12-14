<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/mysql', function () {
    Artisan::call('migrate:rollback', ['--force' => true]);
    Artisan::call('migrate', ['--force' => true]);
    Artisan::call('db:seed', ['--force' => true]);
});

Route::get('/', function () {
    return view('guest/guest');
});

Route::get('/guest/listproduk', [GuestController::class, 'index']);


Route::group(['middleware' =>['auth', 'cekRole:admin,user']],function(){
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::resource('kategori', KategoriController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('barang', BarangController::class);
    
});

Route::group(['middleware' =>['auth', 'cekRole:user']],function(){
   
    
    Route::get('/cart-index',[CartController::class, 'index']);
    Route::post('cart/{id}', [CartController::class, 'tambahCart']);
    Route::delete('cart-delete/{id}', [CartController::class, 'deleteCart']);
    Route::get('check-out',[CartController::class, 'checkOut']);
    Route::post('add-address', [CartController::class, 'addAdress']);
    Route::get('edit-address/{id}', [CartController::class, 'editAddress']);
    Route::get('delete-address/{id}', [CartController::class, 'deleteAddress'])->name("deleteAddress");
    Route::post('store-edit-address/{id}', [CartController::class, 'storeEditAddress']);
    Route::post('store-payment/{id}', [CartController::class, 'storePayment']);
    Route::get('/riwayat-transaksi', [CartController::class, 'indexTransaction']);
    Route::get('/cetak-transaksi/{id}', [CartController::class, 'prinTransaction']);


});




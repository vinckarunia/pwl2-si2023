<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//route resource for products
<<<<<<< HEAD
Route::resource('suppliers', \App\Http\Controllers\SupplierController::class);
=======
Route::resource('/products', \App\Http\Controllers\ProductController::class);
Route::resource('/suppliers', \App\Http\Controllers\SupplierController::class);
Route::resource('/transaksi_penjualans', \App\Http\Controllers\TransaksiPenjualanController::class);
Route::resource('/detail_transaksi_penjualans', \App\Http\Controllers\detailTransaksiPenjualanController::class);
>>>>>>> 99612a18c55ecfd8e7173edc3d41580f6614c02a

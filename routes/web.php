<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//route resource for products
Route::resource('suppliers', \App\Http\Controllers\SupplierController::class);
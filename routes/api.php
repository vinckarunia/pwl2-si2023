<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::apiResource('users', UserController::class);
Route::post('login', [UserController::class, 'login']);

Route::get('test', function () {
    return response()->json(['message' => 'API is working!']);
});

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

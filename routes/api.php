<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return response()->json(['Welcome' => 'Why are you here Curious cat?']);
});



Route::apiResource('users', UserController::class)->only(['index', 'show']);
Route::put('/user', [UserController::class, 'update'])->name('user.update')->middleware('auth:sanctum');




Route::prefix('auth')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::post('login', [AuthController::class, 'authenticate'])->name('authenticate');
        Route::post('register', [AuthController::class, 'store'])->name('register.store');
    });
    Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:sanctum');
});





Route::middleware(['auth:sanctum','can:admin-role'])->prefix('admin')->name('admin.')->group(function () {
    Route::apiResource('users', AdminUserController::class);
});

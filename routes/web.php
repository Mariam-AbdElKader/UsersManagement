<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

Route::middleware('auth')->group(function () {
    Route::get('/user', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user', [UserController::class, 'update'])->name('user.update');
});

Route::prefix('auth')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'login'])->name('login');
        Route::post('login', [AuthController::class, 'authenticate'])->name('authenticate');
        Route::get('register', [AuthController::class, 'register'])->name('register');
        Route::post('register', [AuthController::class, 'store'])->name('register.store');
    });
    Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
});

Route::middleware(['auth','can:admin-role'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', function () {
        return to_route('admin.users.index');
    })->name('dashboard');

    Route::resource('users', AdminUserController::class);
});

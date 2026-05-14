<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TruckController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
| Example: granular route protection (OR semantics with "|")
| Route::post('users', [UserController::class, 'store'])->middleware('permission:users.create|users.edit');
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->middleware('permission:admin.dashboard')
        ->name('dashboard');

    Route::resource('users', UserController::class);

    Route::resource('roles', RoleController::class)->except(['show']);

    Route::get('products', [ProductController::class, 'index'])
        ->middleware('permission:products.view')
        ->name('products.index');

    Route::resource('trucks', TruckController::class);
});

Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/account/change-password/{uid}', [AccountController::class, 'changePassword'])
        ->name('account.changePassword');
    Route::put('/account/change-password/{uid}', [AccountController::class, 'updateChangePassword'])
        ->name('account.updatePassword');
    Route::resource('account', AccountController::class);
});

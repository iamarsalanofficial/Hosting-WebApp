<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;



Route::get('/pricing', [PricingController::class, 'showPricing'])->name('pricing.page');
Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'show'])->name('checkout.process');



Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'AuthLogin']);
Route::post('/register', [AuthController::class, 'AuthSignup']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/forgot-password', [AuthController::class, 'forgotpassword']);
Route::post('/forgot-password', [AuthController::class, 'PostForgotPassword']);
Route::get('/reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'PostReset']);

Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/index', [DashboardController::class, 'dashboard']);
    // Route::get('admin/admin/list', [AdminController::class, 'list']);
    // Route::get('admin/admin/add', [AdminController::class, 'add']);
    // Route::post('admin/admin/add', [AdminController::class, 'insert']);
    // Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    // Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    // Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);
});

Route::group(['middleware' => 'user'], function () {
    
    Route::get('user/dashboard', [DashboardController::class, 'dashboard']);
    // Route::get('admin/admin/list', [AdminController::class, 'list']);
    // Route::get('admin/admin/add', [AdminController::class, 'add']);
    // Route::post('admin/admin/add', [AdminController::class, 'insert']);
    // Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    // Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    // Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);
});
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DetailProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::post('/search', [UserController::class, 'search'])->name('search');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');


    Route::get('/add-product', [ProductController::class, 'index'])->name('product');
    Route::post('/add-product', [ProductController::class, 'store'])->name('product.store');
    Route::get('products/{productId}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::post('/product/{product}/duplicate', [ProductController::class, 'duplicate'])->name('product.duplicate');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::get('/detail-products/{product}', [DetailProductController::class, 'index'])->name('detail-product');

    Route::get('/icons', function () {
    $icons = Storage::get('icons.json');
    return response()->json(json_decode($icons, true));
});
});

require __DIR__.'/auth.php';

Route::get('/make-password', function () {return view('auth.make-password');})->name('make-password');

Route::get('/success-send-email', function () {return view('auth.success-send-email');});

Route::get('/success-reset', function () {return view('auth.success-reset');})->name('success-reset');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


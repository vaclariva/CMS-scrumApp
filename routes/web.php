<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/member', [App\Http\Controllers\MemberController::class, 'index'])->name('member');

Route::get('/add-member', [App\Http\Controllers\AddMemberController::class, 'index'])->name('add-member');

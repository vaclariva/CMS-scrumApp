<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/student', [App\Http\Controllers\StudentController::class, 'index'])->name('student');

Route::get('/add-student', [App\Http\Controllers\AddStudentController::class, 'index'])->name('add-student');

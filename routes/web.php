<?php

use App\Http\Controllers\BacklogController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DetailProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\VisionBoardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/role', [RoleController::class, 'index'])->name('role.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/user', [UserController::class, 'index'])->name('user');
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

    Route::post('/detail-product', [VisionBoardController::class, 'store'])->name('vision-board.store');
    Route::put('product/{product}/vision_board/{visionBoard}', [VisionBoardController::class, 'update'])->name('visionBoard.update');
    Route::delete('/product/{product}/vision_board/{visionBoard}', [VisionBoardController::class, 'destroy'])->name('visionBoard.destroy');
    Route::post('/product/{product}/vision_board/{visionBoard}/duplicate', [VisionBoardController::class, 'duplicate'])->name('visionBoard.duplicate');

    Route::post('product/{productId}/backlog', [BacklogController::class, 'store'])->name('backlog.store');
    Route::get('product/{productId}/sprint/{sprintId}/backlogs', [BacklogController::class, 'index'])->name('backlogs.index');
    Route::get('product/{product}/backlogs/{backlog}', [BacklogController::class, 'edit'])->name('backlogs.edit');
    Route::put('product/{product}/backlogs/{backlog}', [BacklogController::class, 'update'])->name('backlogs.update');
    Route::delete('/product/{product}/backlog/{backlog}', [BacklogController::class, 'destroy'])->name('backlogs.destroy');
    Route::post('/product/{product}/backlog/{backlog}/duplicate', [BacklogController::class, 'duplicate'])->name('backlogs.duplicate');

    // Menampilkan daftar backlog untuk product tertentu dan sprint tertentu
    Route::get('/products/{productId}/sprints/{sprintId}/backlogs', [BacklogController::class, 'index'])->name('backlogs.index');

    // Menyimpan backlog baru
    Route::post('/backlogs', [BacklogController::class, 'store'])->name('backlogs.store');

    // Menampilkan detail backlog berdasarkan ID
    Route::get('/backlogs/{id}', [BacklogController::class, 'show'])->name('backlogs.show');

    // Menampilkan form edit backlog (opsional, jika diperlukan halaman edit)
    Route::get('/products/{product}/backlogs/{backlog}/edit', [BacklogController::class, 'edit'])->name('backlogs.edit');

    // Memperbarui backlog yang ada
    Route::put('/backlogs/{id}', [BacklogController::class, 'update'])->name('backlogs.update');

    // Menghapus backlog
    Route::delete('/products/{product}/backlogs/{backlog}', [BacklogController::class, 'destroy'])->name('backlogs.destroy');

    // Menambah atau memperbarui checklist pada backlog tertentu
    Route::post('/backlogs/{backlog_id}/checklists', [BacklogController::class, 'storeOrUpdateChecklist'])->name('backlogs.checklists.storeOrUpdate');

    // Menduplicate backlog beserta checklist-nya
    Route::post('/products/{product}/backlogs/{backlog}/duplicate', [BacklogController::class, 'duplicate'])->name('backlogs.duplicate');

    Route::get('/products/{id}/sprints', [SprintController::class, 'index'])->name('sprints.index');
    Route::get('/products/{id}/sprints/create', [SprintController::class, 'create'])->name('sprints.create');
    Route::get('/products/{product}/sprints/{sprintId}/edit', [SprintController::class, 'edit'])->name('sprints.edit');
    Route::put('/products/{product}/sprints/{sprintId}', [SprintController::class, 'update'])->name('sprints.update');
    Route::post('/products/{id}/sprints', [SprintController::class, 'store'])->name('sprints.store');
    Route::delete('/products/{id}/sprints/{sprintId}', [SprintController::class, 'destroy'])->name('sprints.destroy');

    Route::get('/icons', function () {
        $icons = Storage::get('icons.json');
        return response()->json(json_decode($icons, true));
    });
});

require __DIR__ . '/auth.php';

Route::get('/make-password', function () {
    return view('auth.make-password');
})->name('make-password');

Route::get('/success-send-email', function () {
    return view('auth.success-send-email');
});

Route::get('/success-reset', function () {
    return view('auth.success-reset');
})->name('success-reset');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

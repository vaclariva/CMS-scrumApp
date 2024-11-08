<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\BacklogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\VisionBoardController;
use App\Http\Controllers\DetailProductController;

Route::get('/', function () {
    return redirect('dashboard');
});

Route::middleware([
    'middleware' => 'auth',
    //'auth.twofactor',
    'web',
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/role', [RoleController::class, 'index'])->name('role.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/users/{user}/resend-email', [UserController::class, 'resendEmailRegister'])->name('users.resend-email');
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
    Route::put('product/{product}/vision_board/{visionBoard}/title', [VisionBoardController::class, 'updateTitle'])->name('visionBoard.updateTitle');
    Route::put('product/{product}/vision_board/{visionBoard}', [VisionBoardController::class, 'update'])->name('visionBoard.update');
    Route::delete('/product/{product}/vision_board/{visionBoard}', [VisionBoardController::class, 'destroy'])->name('visionBoard.destroy');
    Route::post('/product/{product}/vision_board/{visionBoard}/duplicate', [VisionBoardController::class, 'duplicate'])->name('visionBoard.duplicate');

    Route::post('product/{productId}/backlog', [BacklogController::class, 'store'])->name('backlog.store');
    Route::put('products/{product}/backlogs/{backlog}', [BacklogController::class, 'update'])->name('backlogs.update');
    Route::put('products/{product}/backlogs/{backlog}/title', [BacklogController::class, 'updateTitle'])->name('backlogs.updateTitle');
    Route::delete('/product/{product}/backlog/{backlog}', [BacklogController::class, 'destroy'])->name('backlogs.destroy');
    Route::post('/product/{product}/backlog/{backlog}/duplicate', [BacklogController::class, 'duplicate'])->name('backlogs.duplicate');
    Route::get('/products/{productId}/sprints/{sprintId}/backlogs', [BacklogController::class, 'index'])->name('backlogs.index');
    Route::get('/products/{product}/backlogs/{backlog}/edit', [BacklogController::class, 'edit'])->name('backlogs.edit');
    Route::get('/backlogs/{backlog_id}/download', [BacklogController::class, 'download'])->name('backlogs.download');

    Route::post('/backlogs/{backlog_id}/checklists', [BacklogController::class, 'storeOrUpdateChecklist'])->name('backlogs.checklists.storeOrUpdate');

    // Route::post('/backlogs/{backlog}/checklists', [ChecklistController::class, 'store'])->name('checklists.store');
    Route::put('/checklists/{checklist}', [ChecklistController::class, 'update'])->name('checklists.update');
    Route::delete('checklists/{id}/{backlogId}', [ChecklistController::class, 'destroy'])->name('checklists.destroy');


    Route::get('/products/{id}/sprints', [SprintController::class, 'index'])->name('sprints.index');
    Route::get('/products/{id}/sprints/create', [SprintController::class, 'create'])->name('sprints.create');
    Route::get('/products/{product}/sprints/{sprintId}/edit', [SprintController::class, 'edit'])->name('sprints.edit');
    Route::put('/products/{product}/sprints/{sprintId}', [SprintController::class, 'update'])->name('sprints.update');
    Route::post('/products/{id}/sprints', [SprintController::class, 'store'])->name('sprints.store');
    Route::delete('/products/{id}/sprints/{sprintId}', [SprintController::class, 'destroy'])->name('sprints.destroy');
    
    Route::controller(SettingController::class)->name('settings.')->prefix('/settings')->group(function () {
        Route::name('twofactors.')->prefix('two-factor')->group(function () {
            Route::get('/', 'showTwoFactorPage')->name('index');
            Route::patch('/', 'updateTwoFactor')->name('update');
        });
    });

    Route::get('/icons', function () {
        $icons = file_get_contents(public_path('assets/icons.json'));
        return response()->json(json_decode($icons, true));
    });


    Route::get('/confirm', function () {
        return view('auth.confirm-password');
    })->name('confirm-password');

    

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

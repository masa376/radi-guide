<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Public as PublicController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ===========================
// 一般ユーザー側ルート
// ===========================
Route::get('/', [PublicController\HomeController::class, 'index'])->name('home');

Route::get('/examinations', [PublicController\ExaminationController::class, 'index'])
    ->name('examinations.index');

Route::get('/examinations/{slug}', [PublicController\ExaminationController::class, 'show'])
    ->name('examinations.show');

Route::get('/faqs', [PublicController\FaqController::class, 'index'])
    ->name('faqs.index');


// ==========================
// 管理者側ルート
// ==========================
Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

        Route::get('/', function () {
            return redirect()->route('admin.categories.index');
        });

        Route::resource('categories', Admin\CategoryController::class);
        Route::resource('examinations', Admin\ExaminationController::class);
        Route::resource('checklists', Admin\ChecklistController::class);
        Route::resource('faqs', Admin\FaqController::class);
    });


// ==========================
// 認証ルート（Breeze）
// ==========================
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



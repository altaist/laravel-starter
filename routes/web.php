<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Tasks\ActionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index']);

Route::get('/shop', function () {
    return Inertia::render('Shop/Start');
})->name('shop.start');

Route::get('/shop/main', function () {
    return Inertia::render('Shop/Main');
})->name('shop.main');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/task/{taskId}/action/', [ActionController::class, 'create'])->name('action.create');

});

require __DIR__.'/auth.php';

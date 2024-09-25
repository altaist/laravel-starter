<?php

use App\Http\Controllers\Tasks\ActionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/task/{taskId}/action/', [ActionController::class, 'create'])->name('action.create');


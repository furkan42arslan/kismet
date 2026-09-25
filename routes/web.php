<?php

use App\Http\Controllers\ContentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ContentController::class, 'index'])->name('home');
Route::get('/get-random', [ContentController::class, 'getRandom'])->name('content.random');
Route::get('/get-daily', [ContentController::class, 'getDaily'])->name('content.daily');
Route::get('/admin/icerikler', [ContentController::class, 'adminIndex'])->name('admin.contents');
Route::post('/admin/icerikler', [ContentController::class, 'store'])->name('admin.contents.store');
Route::delete('/admin/icerikler/{id}', [ContentController::class, 'destroy'])->name('admin.contents.destroy');

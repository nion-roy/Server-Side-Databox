<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('users.index');
Route::get('/create', [App\Http\Controllers\HomeController::class, 'create'])->name('users.create');
Route::post('/users', [App\Http\Controllers\HomeController::class, 'store'])->name('users.store');
Route::get('/users/{id}/edit', [App\Http\Controllers\HomeController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('users.update');
Route::delete('/users/{id}/delete', [App\Http\Controllers\HomeController::class, 'destroy'])->name('users.destroy');

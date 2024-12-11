<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/users/retrieved', [App\Http\Controllers\HomeController::class, 'retrievedUser'])->name('users.retrieved');
Route::post('/status/{id}', [App\Http\Controllers\HomeController::class, 'statusUser'])->name('status.update');
Route::get('/users/{id}/view', [App\Http\Controllers\HomeController::class, 'viewUser']);
Route::post('/users/{id}/edit', [App\Http\Controllers\HomeController::class, 'editUser']);
Route::delete('/users/{id}/delete', [App\Http\Controllers\HomeController::class, 'deleteUser']);

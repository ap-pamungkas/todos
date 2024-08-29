<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', [TodoController::class, 'index'])->name('todos.index');
Route::post('/store', [TodoController::class, 'store'])->name('todos.store');
Route::put('/update-status/{id}', [TodoController::class, 'updateStatus'])->name('todos.updateStatus');
Route::post('/clear-completed', [TodoController::class, 'clearCompleted'])->name('todos.clearCompleted');
Route::get('/filter', [TodoController::class, 'filter'])->name('todos.filter');
Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');

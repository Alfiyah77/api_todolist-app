<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TodoListController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (): void {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/todos', [TodoListController::class, 'index']);
    Route::post('/todos', [TodoListController::class, 'store']);
    Route::get('/todos/{id}', [TodoListController::class, 'show']);
    Route::put('/todos/{id}', [TodoListController::class, 'update']);
    Route::patch('/todos/{id}/status', [TodoListController::class, 'updatestatus']);
    Route::delete('/todos/{id}', [TodoListController::class, 'destroy']);
});
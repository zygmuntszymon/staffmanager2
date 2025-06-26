<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\RedemptionController;
use App\Http\Controllers\DashboardController;

Route::get('/', fn() => redirect()->route('dashboard'));

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    // Zadania
    Route::resource('tasks', TaskController::class)
         ->except(['show','create','edit']);
    Route::post('tasks/{task}/complete', [TaskController::class,'complete'])
         ->name('tasks.complete');

    // Urlopy
    Route::resource('leaves', LeaveController::class)
         ->only(['index','create','store']);
    Route::post('leaves/{leave}/approve', [LeaveController::class,'approve'])
         ->name('leaves.approve');
    Route::post('leaves/{leave}/reject',  [LeaveController::class,'reject'])
         ->name('leaves.reject');

    // Benefity
    Route::resource('redemptions', RedemptionController::class)
         ->only(['index','store']);
});

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\WineController;
use App\Http\Controllers\Admin\WineryController;
use App\Http\Controllers\Admin\OrderController;

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth','role:admin,editor'])
    ->group(function(){
        Route::get('/',[DashboardController::class,'index'])->name('dashboard');
        Route::resource('categories',CategoryController::class);
        Route::resource('wines',WineController::class);
        Route::resource('wineries',WineryController::class);

        Route::get('orders',[OrderController::class, 'index'])->name('orders.index');
        Route::patch('orders/{order}',[OrderController::class,'update'])->name('orders.update');
    });

require __DIR__.'/auth.php';

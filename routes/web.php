<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\WineController;
use App\Http\Controllers\Admin\WineryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\OrderController as UserOrderController;
use App\Http\Controllers\CartController;
// ---------- JAVNE RUTE ----------
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/vinska-karta', [PublicController::class, 'catalog'])->name('catalog');
Route::get('/vino/{wine}', [PublicController::class, 'wine'])->name('wine.show');
Route::get('/kontakt', [PublicController::class, 'contact'])->name('contact');
Route::post('/kontakt', [PublicController::class, 'sendContact'])->name('contact.send');

// ---------- BREEZE: dashboard + profil ----------
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/moje-porudzbine', [UserOrderController::class, 'index'])->name('orders.my');
Route::post('/poruci/{wine}', [UserOrderController::class, 'store'])->name('orders.store');
Route::middleware('auth')->group(function () {

    Route::post('/korpa/poruci', [CartController::class, 'checkout'])->name('cart.checkout');
    });
    Route::get('/korpa', [CartController::class, 'index'])->name('cart.index');
    Route::post('/korpa/dodaj/{wine}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/korpa/izmeni/{wine}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/korpa/izbaci/{wine}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/korpa/isprazni', [CartController::class, 'clear'])->name('cart.clear');
    

// ---------- ADMIN RUTE ----------
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth','role:admin,editor'])
    ->group(function(){
        Route::get('/',[DashboardController::class,'index'])->name('dashboard');
        Route::resource('categories',CategoryController::class);
        Route::resource('wines',WineController::class);
        Route::resource('wineries',WineryController::class);

        Route::get('orders',[OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::patch('orders/{order}',[OrderController::class,'update'])->name('orders.update');
    });

require __DIR__.'/auth.php';
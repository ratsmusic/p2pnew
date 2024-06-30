<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BinanceController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\KucoinController;
use App\Http\Controllers\OkexController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/binance', [BinanceController::class, 'index'])->name('binance');
    Route::get('/countries', [CountryController::class, 'index'])->name('countries');
    Route::get('/cryptos', [CryptoController::class, 'index'])->name('cryptos');
    Route::get('/exchanges', [ExchangeController::class, 'index'])->name('exchanges');
    Route::get('/kucoin', [KucoinController::class, 'index'])->name('kucoin');
    Route::get('/okex', [OkexController::class, 'index'])->name('okex');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments');
    Route::get('/prices', [PriceController::class, 'index'])->name('prices');
    Route::view('/black-list', 'black.index')->name('black');
    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Transaction
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
});

require __DIR__.'/auth.php';

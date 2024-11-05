<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(PayPalController::class)->group(function(){
    Route::get('/', 'index')->name('paypal');
    Route::post('/paypal/payment', 'ckeckout')->name('paypal.payment');
    Route::get('/paypal/payment/success', 'success')->name('paypal.success');
    Route::get('/paypal/payment/cancel', 'cancel')->name('paypal.cancel');
});

// Route::get('paypal/payment',[PayPalController::class, 'ckeckout'])->name('paypal.payment');
// Route::get('paypal/payment/success',[PayPalController::class, 'success'])->name('paypal.success');
// Route::get('paypal/payment/cancel',[PayPalController::class, 'cancel'])->name('paypal.cancel');
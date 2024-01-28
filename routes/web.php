<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/payment/initiate/{amount}/{oder_key}', [PaymentController::class, 'initiatePayments'])->name('initiatePayments');
Route::get('/payment/notification', [PaymentController::class, 'retrievePaymentDetails']);
Route::get('/recurring-payment', [PaymentController::class, 'recurringPayment'])->name('recurring-payment');
<?php

use App\Http\Controllers\Payment\KashierPaymentController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/kashier/success', [KashierPaymentController::class, 'success'])
    ->name('kashier.success');

Route::get('/kashier/failure', [KashierPaymentController::class, 'failure'])
    ->name('kashier.failure');

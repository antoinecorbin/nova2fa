<?php

use Antoinecorbin\Nova2fa\Http\Controllers\TwoFactorController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth', '2fa.redirect_if_verified'])->group(function () {
    Route::get('/nova/2fa/verify', [TwoFactorController::class, 'showVerificationForm'])->name('nova.2fa.verify');
    Route::post('/nova/2fa/verify', [TwoFactorController::class, 'verifyCode']);
});

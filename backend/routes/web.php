<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

$limiter = config('fortify.limiters.login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware(array_filter([
    'guest',
    $limiter ? 'throttle:'.$limiter : null,
]));

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

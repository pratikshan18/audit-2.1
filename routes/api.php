<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\EnsureFrontendRequestsAreStateful;

Route::middleware([
    EnsureFrontendRequestsAreStateful::class,
    'web' // include session + csrf
])->group(function () {
    Route::post('/login_action', [LoginController::class, 'login']);
});


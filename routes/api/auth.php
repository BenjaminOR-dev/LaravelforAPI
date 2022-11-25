<?php

/**
 * ---------------------------------------------------------------------------
 * Rutas Api "Auth"
 * ---------------------------------------------------------------------------
 *
 * @api {{host}}/api/auth
 */

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->withoutMiddleware('auth');
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
});

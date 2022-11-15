<?php

/**
 * ---------------------------------------------------------------------------
 * Rutas Api "Prueba"
 * ---------------------------------------------------------------------------
 *
 * @api {{host}}/api/prueba
 * ---------------------------------------------------------------------------
 */

use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ResponseHelper::json('Hola mundo');
});

<?php

/**
 * ---------------------------------------------------------------------------
 * Rutas Api "Prueba"
 * ---------------------------------------------------------------------------
 *
 * @api {{host}}/api/prueba
 * ---------------------------------------------------------------------------
 */

use App\Enums\HttpStatusEnum;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    ResponseHelper::send404();
});

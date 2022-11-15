<?php

use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return ResponseHelper::json();
});

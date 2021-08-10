<?php

use Illuminate\Support\Facades\Route;
use Artisanpay\Controllers\ChargeHookController;

Route::post('artisanpay/hooks', ChargeHookController::class);
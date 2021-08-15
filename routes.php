<?php

use Illuminate\Support\Facades\Route;
use Artisanpay\Controllers\ChargeHookController;

Route::post(config('artisanpay.url_webhook'), ChargeHookController::class);
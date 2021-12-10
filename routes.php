<?php

use Illuminate\Support\Facades\Route;

if( (boolean) config('artisanpay.process_manually') === false){
    Route::post(config('artisanpay.url_webhook'), \Artisanpay\Controllers\ChargeHookController::class);
    Route::post(config('artisanpay.url_webhook').'/{id}', \Artisanpay\Controllers\ChargeHookController::class);
}

<?php

return [
    /**
     * -------------------------------------------
     *  Api Token provide buy ArtisanPay
     * -------------------------------------------
     */
    'token' => env('ARTISANPAY_TOKEN'),

    'base_url' => env('ARTISANPAY_BASE_URL', 'https://app.artisanpay.com/api/v1'),

    /**
     * --------------------------------------------
     * A Job to Handler Hook Payment
     * ---------------------------------------------
     */

    'dispatcher' => '',  // ArtisanWebookHandler::class , 

    /**
     * ----------------------------------------------
     * URL route to handle payment
     * ----------------------------------------------
     * 
     */
    'url_webhook'   => env('ARTISANPAY_WEBHOOK', 'artisanpay/hooks')
];
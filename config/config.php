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

    'job' => '',  // ArtisanWebookHandler::class , 

    /**
     * ----------------------------------------------
     * URL route to handle payment
     * ----------------------------------------------
     * 
     */
    'url_webhook'       => env('ARTISANPAY_WEBHOOK', 'api/artisanpay/hooks'),
    'process_manuelly'  => false
];
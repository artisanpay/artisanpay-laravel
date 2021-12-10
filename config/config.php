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

<<<<<<< HEAD
    /**
     * ----------------------------------------------
     * URL route to handle payment
     * ----------------------------------------------
     * 
     */
    'url_webhook'   => env('ARTISANPAY_WEBHOOK', 'artisanpay/hooks')
=======
    'url_webhook'       => env('ARTISANPAY_WEBHOOK', 'api/artisanpay/hooks'),
    'process_manuelly'  => false
>>>>>>> faaa6896216295a3aa1837fb7fa86f81bb327728
];
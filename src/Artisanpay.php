<?php

namespace Artisanpay;

use Illuminate\Support\Facades\Facade;
/**
 * 
 * @method static \Artisanpay\Dto\PaymentResponse charge(\Artisanpay\Dto\ChargeRequest $charge)
 * @see \Artisanpay\Artisanpay
 */
class ArtisanPay extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'artisanpay-laravel';
    }
}

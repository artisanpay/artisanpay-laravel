<?php

namespace Artisanpay\Facades;

use Illuminate\Support\Facades\Facade;
/**
 * 
 * @method static \Artisanpay\Dto\ChargeResponse charge(\Artisanpay\Dto\ChargeRequest $charge)
 * @see \Artisanpay\ArtisanpayCharge
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

<?php

namespace Artisanpay;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Artisanpay\LaravelPayment\Skeleton\SkeletonClass
 */
class ArtisanPayFacade extends Facade
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

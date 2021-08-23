# Laravel bridge for ArtisanPay

[![Latest Version on Packagist](https://img.shields.io/packagist/v/artisanpay/artisanpay-laravel.svg?style=flat-square)](https://packagist.org/packages/artisanpay/artisanpay-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/artisanpay/artisanpay-laravel.svg?style=flat-square)](https://packagist.org/packages/artisanpay/artisanpay-laravel)
![GitHub Actions](https://github.com/artisanpay/artisanpay-laravel/actions/workflows/main.yml/badge.svg)

:warning:
This package still in development not use in production 

## Installation

You can install the package via composer:

```bash
composer require artisanpay/artisanpay-laravel
```

Install package

```bash
php artisan artisanpay:install 
```

Add artisanpay api token in config file  in .env 

```bash
ARTISANPAY_TOKEN=xxxxxxxxxxxxxxxxxx
```
Generate Job to handle payment

```bash
php artisan make:job ArtisanpayHookHandleJob
```
Add Job to config file in dispatcher section 

```php

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

    'job' => \App\Jobs\ArtisanpayHookChargeJob::class,  // ArtisanWebookHandler::class , 

    'url_webhook'   => env('ARTISANPAY_WEBHOOK', 'artisanpay/hooks')
];


```

## Usage

Create payment artisanpay support for this version 2 operator

OrangeMoney ==> 'om'
MTN Mobile Money => 'momo'


```php
$data = $request->validate([
            'phone'     => 'required',
            'amount'    => 'required',
            'operator'  => 'required'
        ]);

        try{
            $response = Artisanpay::charge( (new ChargeRequest($request->phone, $request->amount, $request->operator)) );
        }catch(Exception $exception){

        }

    
```

Job To handle payment hook

```php
<?php

namespace App\Jobs;

use ChargeHookResponse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ArtisanpayHookChargeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     * @param  ChargeHookResponse $name
     * @return void
     */
    public function __construct(private ChargeHookResponse $chargeHookResponse)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       match($this->chargeHookResponse->getStatus()){
            'success'   => $this->proccessSuccess(),
            'failed'    => $this->proccessFailed(),
       };
    }

    private function proccessSuccess()
    {

    }

    private function proccessFailed()
    {

    }
}
```


### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email artisanpay@gmail.com instead of using the issue tracker.

## Credits

-   [Gildas Tema](https://github.com/artisanpay)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.



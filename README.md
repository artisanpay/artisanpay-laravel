# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/artisanpay/laravel-payment.svg?style=flat-square)](https://packagist.org/packages/artisanpay/laravel-payment)
[![Total Downloads](https://img.shields.io/packagist/dt/artisanpay/laravel-payment.svg?style=flat-square)](https://packagist.org/packages/artisanpay/laravel-payment)
![GitHub Actions](https://github.com/artisanpay/laravel-payment/actions/workflows/main.yml/badge.svg)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require artisanpay/artisanpay-laravel
```

Install package

```bash
php artisan artisanpay:install 
```

Add artisanpay api token in config file 

Generate Job to handle payment

```bash
php artisan make:job ArtisanpayHookHandleJob
```
Add Job to config file in dispatcher section 

## Usage

Create payment


```php
$data = $request->validate([
            'phone'     => 'required',
            'amount'    => 'required',
            'operator'  => 'required'
        ]);

        try{
            $response = Artisanpay::charge( (new ChargeRequest($request->phone, $request->amount, $request->operator)) );
            Payment::create($data);

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

If you discover any security related issues, please email gildastema3@gmail.com instead of using the issue tracker.

## Credits

-   [Gildas Tema](https://github.com/artisanpay)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.



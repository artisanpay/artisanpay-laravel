<?php
namespace Artisanpay\Tests;

use Illuminate\Support\Str;
use Orchestra\Testbench\TestCase;
use Artisanpay\Tests\FakeHandleJob;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Config;

class ChargeHookControllerTest extends TestCase
{
    public function handle_payment()
    {
        Config::set('artisanpay.dispatcher', \Artisanpay\Tests\FakeHandleJob::class);
        Bus::fake();
        $response =  $this->postJson('artisanpay/hooks', [
            'id'    => $id = (string) Str::uuid(),
            'status'    => 'success',
            'operator_message' => 'payment ok'
        ]);


    }
}

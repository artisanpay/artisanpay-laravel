<?php
namespace Artisanpay\Tests;

use Illuminate\Support\Str;
use Orchestra\Testbench\TestCase;
use Artisanpay\Tests\FakeHandleJob;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Config;

use function Composer\Autoload\includeFile;

class ChargeHookControllerTest extends TestCase
{
    /** @test */
    public function handle_payment()
    {
        Config::set('artisanpay.url_webhook', 'api/artisanpay/hooks');
        includeFile('routes.php');
        Config::set('artisanpay.job', \Artisanpay\Tests\FakeHandleJob::class);
      
        
        Bus::fake();
        $response =  $this->postJson('api/artisanpay/hooks', [
            'id'    => $id = (string) Str::uuid(),
            'status'    => 'success',
            'operator_message' => 'payment ok'
        ]);
        // assert
        $response->assertSuccessful();
        Bus::assertDispatched(FakeHandleJob::class);
    }
}

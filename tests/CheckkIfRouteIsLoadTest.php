<?php
namespace Artisanpay\Tests;

use Illuminate\Support\Str;
use Orchestra\Testbench\TestCase;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Config;
use function Composer\Autoload\includeFile;

class CheckkIfRouteIsLoadTest extends TestCase
{
    /** @test */
    public function route_artisanpay_is_define_when_proces_manuelly_is_false()
    {
        Config::set('artisanpay.process_manually', false);
        Config::set('artisanpay.url_webhook', 'artisanpay/hooks');
        Config::set('artisanpay.job', \Artisanpay\Tests\FakeHandleJob::class);
        Bus::fake();
        includeFile('routes.php');
       
        $response =  $this->postJson('/artisanpay/hooks', [
            'id'    =>  (string) Str::uuid(),
            'status'    => 'success',
            'operator_message' => 'payment ok'
        ]);
        // assert
        $response->assertSuccessful();
    }

    /** @test */
    public function route_artisanpay_is_define_when_proces_manuelly_is_true()
    {
        Config::set('artisanpay.process_manually', true);
        Config::set('artisanpay.url_webhook', 'artisanpay/hooks');
        Config::set('artisanpay.job', \Artisanpay\Tests\FakeHandleJob::class);
        Bus::fake();
        includeFile('routes.php');
       
        $response =  $this->postJson('/artisanpay/hooks', [
            'id'    =>  (string) Str::uuid(),
            'status'    => 'success',
            'operator_message' => 'payment ok'
        ]);
        // assert
        $response->assertStatus(404);
    }
}

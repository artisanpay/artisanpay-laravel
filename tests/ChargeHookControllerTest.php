<?php
namespace Artisanpay\Tests;

use Illuminate\Support\Str;
use Orchestra\Testbench\TestCase;
use Artisanpay\Tests\FakeHandleJob;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Config;
use Artisanpay\Exceptions\HookJobNotFoundException;


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

    /** 
     * @test 
    */
    public function charge_failed_when_handle_not_found()
    {
        Config::set('artisanpay.url_webhook', 'api/artisanpay/hooks');
        includeFile('routes.php');
        Config::set('artisanpay.job', 'hello');
      
        
        Bus::fake();
        $response =  $this->postJson('api/artisanpay/hooks', [
            'id'    => $id = (string) Str::uuid(),
            'status'    => 'success',
            'operator_message' => 'payment ok'
        ]);
        // assert
        $response->assertStatus(500);
        $this->assertEquals(get_class($response->exception) , HookJobNotFoundException::class);
        // dd($response->exception);
    }
}

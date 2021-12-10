<?php
namespace Artisanpay\Tests;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Artisanpay\ArtisanpayCharge;
use Artisanpay\Dto\ChargeRequest;
use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Artisanpay\Exceptions\InvalidTokenException;


class ArtisanpayChargeTest extends TestCase
{
    /** @test */
    public function create_payment_ok_with_handle_route_define_in_config()
    {

       Config::set('artisanpay.process_manually', false);   
       // arrange 
       Http::fake([ 
            '*' => Http::response(['id' => $id = (string) Str::uuid(), 'status' => "pending"])
       ]); 
       $payment =new  ChargeRequest('691131446', 5000, 'om');

       //act
       $response = (new ArtisanpayCharge())->charge($payment);

      $this->assertSame($response->getId() , $id);
    }

    /** @test */
    public function create_payment_failed_if_process_manuelly_is_false_and_not_pass_url()
    {
           $this->expectException(InvalidArgumentException::class);
          Config::set('artisanpay.process_manually', true);   
         
          // arrange 
          Http::fake([ 
               '*' => Http::response(['id' => $id = (string) Str::uuid(), 'status' => "pending"])
          ]); 
          $chargeRequest =new  ChargeRequest('691131446', 5000, 'om');
          //act
    }
    /** @test */
    public function charge_failed_without_exception()
    {
     Config::set('artisanpay.process_manually', true);   
     Http::fake([ 
          '*' => Http::response(['id' => $id = (string) Str::uuid(), 'status' => "failed"], 401)
          ]); 
          $chargeRequest =new  ChargeRequest('691131446', 5000, 'om','', 'https://google.cm');

          $response = (new ArtisanpayCharge())->charge($chargeRequest);

          $this->assertSame(false, $response->successful());
    }

    /** @test */
    public function create_payment_invalid_token()
    {
         // arrange 
        $this->expectException(InvalidTokenException::class);
        Http::fake([ 
        '*' => Http::response(['id' => $id = (string) Str::uuid(), 'status' => "failed"], 401)
        ]); 
        $payment =new  ChargeRequest('691131446', 5000, 'om', 'https://google.cm');
        //act
       (new ArtisanpayCharge)->withException()->charge($payment);
      
       
    }
}


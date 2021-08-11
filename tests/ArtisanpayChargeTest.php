<?php
namespace Artisanpay\Tests;

use Artisanpay\ArtisanpayCharge;
use Artisanpay\ArtisanPayPayment;
use Artisanpay\Dto\ChargeRequest;
use Artisanpay\Dto\Payment;
use Artisanpay\Exceptions\InvalidTokenException;
use Illuminate\Support\Str;
use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Http;


class ArtisanpayChargeTest extends TestCase
{
    /** @test */
    public function create_payment_ok()
    {
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
    public function create_payment_invalid_token()
    {
         // arrange 
        $this->expectException(InvalidTokenException::class);
        Http::fake([ 
        '*' => Http::response(['id' => $id = (string) Str::uuid(), 'status' => "failed"], 401)
        ]); 
        $payment =new  ChargeRequest('691131446', 5000, 'om', 'https://google.cm');
        //act
       (new ArtisanpayCharge)->charge($payment);
      
       
    }
}


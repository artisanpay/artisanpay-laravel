<?php
namespace Artisanpay\Tests;

use Artisanpay\ArtisanPayPayment;
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
            '*' => Http::response(['id' => $id = (string) Str::uuid(), 'message' => "pending"])
       ]); 
       $payment =new  Payment('691131446', 5000, 'om');

       //act
       $response = (new ArtisanPayPayment)->charge($payment);

      $this->assertSame($response->getId() , $id);
    }

    /** @test */
    public function create_payment_invalid_token()
    {
         // arrange 
        $this->expectException(InvalidTokenException::class);
        Http::fake([ 
        '*' => Http::response(['id' => $id = (string) Str::uuid(), 'message' => "failed"], 401)
        ]); 
        $payment =new  Payment('691131446', 5000, 'om', 'https://google.cm');
        //act
       (new ArtisanPayPayment)->charge($payment);
      
       
    }
}


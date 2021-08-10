<?php

namespace Artisanpay;

use Artisanpay\Contracts\ChargeContract;
use Artisanpay\Dto\Payment;
use Artisanpay\Dto\PaymentResponse;
use Artisanpay\Exceptions\InvalidTokenException;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

final class ArtisanpayCharge implements ChargeContract
{
    /**
     * Undocumented function
     * 
     * @throws Exception| InvalidTokenException
     *
     * @param Payment $payment
     * @return PaymentResponse
     */
    public function charge(Payment $payment): PaymentResponse
    {
        $response = Http::withToken( config('artisanpay.token') )->asJson()
                        ->post(config('artisanpay.base_url') .'/payments', [
                            'phone'         => $payment->getPhone(),
                            'amount'        => $payment->getAmount(),
                            'operator'      => $payment->getOperator(),
                            'notify_url'    => $payment->getNotifyUrl()
                        ]);
        if($response->successful()){
            $data = $response->json();
            return new PaymentResponse( Arr::get($data, 'id'), Arr::get($data, 'message') );
        }
        if($response->status() == 401) throw new InvalidTokenException("invalid token", 401); 
        throw new Exception("unkown error", 500);               
    }
}

<?php

namespace Artisanpay;

use Artisanpay\Contracts\ChargeContract;
use Artisanpay\Dto\ChargeRequest;
use Artisanpay\Dto\ChargeResponse;
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
     * @param Payment $chargeRequest
     * @return PaymentResponse
     */
    public function charge(ChargeRequest $chargeRequest): ChargeResponse
    {
        $response = Http::withToken( config('artisanpay.token') )->asJson()
                        ->post(config('artisanpay.base_url') .'/payments', [
                            'phone'         => $chargeRequest->getPhone(),
                            'amount'        => $chargeRequest->getAmount(),
                            'operator'      => $chargeRequest->getOperator(),
                            'notify_url'    => $chargeRequest->getNotifyUrl()
                        ]);
        if($response->successful()){
            $data = $response->json();
            return new ChargeResponse( Arr::get($data, 'id'), Arr::get($data, 'status') );
        }
        if($response->status() == 401) throw new InvalidTokenException("invalid token", 401); 
        throw new Exception("unkown error", 500);               
    }
}

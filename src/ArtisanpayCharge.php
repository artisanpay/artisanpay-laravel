<?php

namespace Artisanpay;

use Artisanpay\Contracts\ChargeContract;
use Artisanpay\Dto\ChargeRequest;
use Artisanpay\Dto\ChargeResponse;
use Artisanpay\Exceptions\InvalidTokenException;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

final class ArtisanpayCharge implements ChargeContract
{

    private bool  $hasException;

    public function __construct(){
        $this->hasException = true;
    }


    /**
     * Undocumented function
     * 
     * @throws Exception| InvalidTokenException
     *
     * @param ChargeRequest $chargeRequest
     * @return ChargeResponse
     */
    public function charge(ChargeRequest $chargeRequest): ChargeResponse
    {
        $response = Http::acceptJson()->withToken( config('artisanpay.token') )->asJson()
                        ->post(config('artisanpay.base_url') .'/payments', [
                            'phone'         => $chargeRequest->getPhone(),
                            'amount'        => $chargeRequest->getAmount(),
                            'operator'      => $chargeRequest->getOperator(),
                            'notify_url'    => $chargeRequest->getNotifyUrl()
                        ]);
        if($response->successful()){
            $data = $response->json();
            return new ChargeResponse( Arr::get($data, 'id'), Arr::get($data, 'status'), true );
        }
        if($response->status() == 401) {
            if($this->hasException)
                throw new InvalidTokenException("invalid token", 401); 
            else{
                return new ChargeResponse(null, "invalid token", false);
            }    
        }else{
            if($this->hasException)
                throw new Exception("unkown error", 500);        
            else{
                return new ChargeResponse(null, "unkown error", false);
            }  
        }
              
    }

    public function withException()
    {
        $this->hasException = true;
        return $this;
    }

    public function withoutException()
    {
        $this->hasException = false;
        return $this;
    }
}

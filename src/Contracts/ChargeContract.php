<?php
namespace Artisanpay\Contracts;

use Artisanpay\Dto\ChargeRequest;
use Artisanpay\Dto\ChargeResponse;
use Artisanpay\Exceptions\InvalidTokenException;

interface ChargeContract{

    /**
     * create Payment
     * 
     * @throws InvalidTokenException
     * @param  ChargeRequest $chargeRequest
     * @return PaymentResponse
     */
    public function charge(ChargeRequest $chargeRequest) : ChargeResponse;
}
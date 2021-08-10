<?php
namespace Artisanpay\Contracts;

use Artisanpay\Dto\Payment;
use Artisanpay\Dto\PaymentResponse;
use Artisanpay\Exceptions\InvalidTokenException;

interface ChargeContract{

    /**
     * create Payment
     * 
     * @throws InvalidTokenException
     * @param Payment $payment
     * @return PaymentResponse
     */
    public function charge(Payment $payment) : PaymentResponse;
}
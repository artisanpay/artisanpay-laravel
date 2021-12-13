<?php

namespace Artisanpay\Tests;

use Artisanpay\Dto\ChargeHookResponse;
use Orchestra\Testbench\TestCase;


class ChargeResponseMapperTest extends TestCase
{
    /** @test */
    public function validate_convert_to_objet()
    {
        $data = [
            'id'                => $id = '1234',
            'amount'            => $amount = '12500',
            'amount_charge'     =>  $amount_charge = '12502',
            'amount_balance'    =>  $amount_balance = '125066',
            'commission'        => $commission =  '1250211',
            'status'            => $status =  'success',
            'type'              =>  $type = 'in',
            'created_at'        =>  $created_at ='2021/10/20 12:50:00',
            'message'           =>  $message = 'operation successful',
            'operator'          => $operator = 'om'
        ];

        $chargeHookResponse = new ChargeHookResponse($data,$ref =  'refId');

        $this->assertEquals($id, $chargeHookResponse->getId());
        $this->assertEquals($amount, $chargeHookResponse->getAmount());
        $this->assertEquals($operator, $chargeHookResponse->getOperator());
        $this->assertEquals($amount_balance, $chargeHookResponse->getAmountBalance());
        $this->assertEquals($commission, $chargeHookResponse->getCommission());
        $this->assertEquals($created_at, $chargeHookResponse->getCreatedAt());
        $this->assertEquals($message, $chargeHookResponse->getMessage());
        $this->assertEquals($type, $chargeHookResponse->getType());
        $this->assertEquals($status, $chargeHookResponse->getStatus());
        $this->assertEquals($amount_charge, $chargeHookResponse->getAmountCharge());
        
        
        
        $this->assertEquals($ref, $chargeHookResponse->getRefId());

    }
}
<?php

namespace Artisanpay\Dto;

final class ChargeRequest{

    /** @var string */
    private string $phone;
    /** @var integer */
    private int $amount;
    /** @var string */
    private string  $operator;
    /** @var  string */
    private string $notifyUrl;

    public function __construct(string $phone, int $amount, string $operator)
    {
        $this->phone = $phone;
        $this->amount = $amount;
        $this->operator = $operator;
        $this->notifyUrl = url('artisanpay/hooks');
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

   

    /**
     * Get the value of amount
     */ 
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Get the value of operator
     */ 
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Get the value of notifyUrl
     */ 
    public function getNotifyUrl()
    {
        return $this->notifyUrl;
    }
}
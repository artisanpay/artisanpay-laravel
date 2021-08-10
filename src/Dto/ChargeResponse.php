<?php
namespace Artisanpay\Dto;

final class ChargeResponse
{
    private  string $id;
    private string $message;
    

    public function __construct(string $id, string $message)
    {
        $this->id = $id;
        $this->message = $message;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of message
     */ 
    public function getMessage()
    {
        return $this->message;
    }
}
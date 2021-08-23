<?php
namespace Artisanpay\Dto;

final class ChargeResponse
{
    private  ?string $id;
    private string $message;
    private bool $isSucces;
    

    public function __construct(?string $id, string $message, bool $isSucces)
    {
        $this->id = $id;
        $this->message = $message;
        $this->isSucces = $isSucces;
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

    public function successful() : bool
    {
        return $this->isSucces;
    }
}
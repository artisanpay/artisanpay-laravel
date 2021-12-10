<?php
namespace Artisanpay\Dto;



final class ChargeHookResponse{
    private string $status;
    private ?string $operatorMessage;
    private string $id;
    /** @var string */
    private $refId;

    public function __construct(string $status, ?string $operatorMessage, string $id , ?string $refId = null)
    {
        $this->id = $id;
        $this->operatorMessage = $operatorMessage;
        $this->status = $status;
        $this->refId = $refId;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the value of operatorMessage
     */ 
    public function getOperatorMessage()
    {
        return $this->operatorMessage;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }
    /**
     * Get Reference Id
     *
     * @return string 
     */
    public function getRefId()
    {
        return $this->refId;
    }
}
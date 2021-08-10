<?php

final class ChargeHookResponse{
    private string $status;
    private string $operatorMessage;
    private string $id;

    public function __construct(string $status, string $operatorMessage, string $id)
    {
        $this->id = $id;
        $this->operatorMessage = $operatorMessage;
        $this->status = $status;
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
}
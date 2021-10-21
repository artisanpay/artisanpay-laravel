<?php

namespace Artisanpay\Dto;

use InvalidArgumentException;

final class ChargeRequest{

    /** @var string */
    private string $phone;
    /** @var integer */
    private int $amount;
    /** @var string */
    private string  $operator;
    /** @var  string */
    private  $notifyUrl;
    /** @var int|string */
    private $id;
   

    public function __construct(string $phone, int $amount, string $operator, ?string $id = null,  ?string $notifyUrl = null )
    {
        $this->phone = $phone;
        $this->amount = $amount;
        $this->operator = $operator;
        $this->id = $id;


        if((bool) config('artisanpay.process_manually') === true &&  $notifyUrl === null){
            throw new InvalidArgumentException("missing notifyUrl");
        }else{
            if( $notifyUrl === null){
                if($id !== null){
                    $this->notifyUrl =config('app.url').'/'.config('artisanpay.url_webhook').'/'.$this->id;
                }else{
                    $this->notifyUrl =config('app.url').'/'.config('artisanpay.url_webhook');
                }
                
            }else{
                $this->notifyUrl = $notifyUrl;
            }
        }
        

        
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
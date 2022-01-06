<?php
namespace Artisanpay\Dto;

use BadMethodCallException;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
/**
 * @method string getId() 
 * @method float getAmountBalance()
 * @method float getAmountCharge()
 * @method float getCommission()
 * @method string getCreatedAt()
 * @method string getStatus()
 * @method float getAmount()
 * @method string getMessage()
 * @method string getType()
 * @method string getOperator()
 * 
 */
final class ChargeHookResponse{
    
    /** @var string */
    public  $refId;
    /** @array<string, strring> */
    private array $data;

    public function __construct(array $data,  ?string $refId = null)
    {
        $this->refId = $refId;
        $this->data = $data;
    }

    private function getElement(string $key){
        return Arr::get($this->data, $key);
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

    public function __get($key)
    {
       return $this->getElement($key);
    }

    public function __call($name, $arguments)
    {
        $name = Str::of($name)->replaceFirst('get', '', $name)->snake()->lower()-> __toString();
        if(in_array($name, array_keys($this->data) )){
           return $this->getElement($name);
        }else{
            throw new BadMethodCallException();
        }
    }
}

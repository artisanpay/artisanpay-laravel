<?php

use Artisanpay\Dto\ChargeHookResponse;

require './vendor/autoload.php';

$r = new ChargeHookResponse(['id' => "5" , "message" => "kolo", "operator_message" => "5000"], 'kiko');

dd($r->getId());
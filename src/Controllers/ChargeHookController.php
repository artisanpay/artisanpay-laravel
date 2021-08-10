<?php
namespace Artisanpay\Controllers;

use Illuminate\Http\Request;
use Artisanpay\Controllers\Controller;
use ChargeHookResponse;

class ChargeHookController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'id'    => 'required',
            'status' => 'required',
            'operator_message' => 'required'
        ]);
        $job = config('artisanpay.dispatcher');
        $data = new ChargeHookResponse($request->status, $request->operator_message, $request->id);
        dispatch( new $job( $data ));
    }
}
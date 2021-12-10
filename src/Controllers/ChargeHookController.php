<?php
namespace Artisanpay\Controllers;

use Illuminate\Http\Request;
use Artisanpay\Controllers\Controller;
use Artisanpay\Dto\ChargeHookResponse;

class ChargeHookController extends Controller
{
    public function __invoke(Request $request, ?string $id)
    {
        $request->validate([
            'id'                => 'required',
            'status'            => 'required',
            'operator_message'  => 'nullable'
        ]);
        $job = config('artisanpay.job');
        $data = new ChargeHookResponse($request->status, $request->operator_message, $request->id, $id);
        dispatch( new $job( $data ));
    }
}
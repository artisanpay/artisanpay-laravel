<?php
namespace Artisanpay\Controllers;

use Illuminate\Http\Request;
use Artisanpay\Controllers\Controller;
use Artisanpay\Dto\ChargeHookResponse;
use Artisanpay\Exceptions\HookJobNotFoundException;

class ChargeHookController extends Controller
{
    public function __invoke(Request $request, ?string $id=null)
    {
        $request->validate([
            'id'                => 'required',
            'status'            => 'required',
        ]);
        $job = config('artisanpay.job');
        if(!class_exists($job, true)){
            throw new HookJobNotFoundException("Hook Job not found");
        }
        $data = new ChargeHookResponse($request->only(['id', 'status', 'message', 'amount','amount_balance', 
                                            'amount_charge', 'commission', 'type', 'operator', 'created_at']), $id);
        dispatch( new $job( $data ));
    }
}
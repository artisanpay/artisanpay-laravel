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
            'operator_message'  => 'nullable'
        ]);
        $job = config('artisanpay.job');
        if(!class_exists($job, true)){
            throw new HookJobNotFoundException("Hook Job not found");
        }
        $data = new ChargeHookResponse($request->status, $request->message, $request->id, $id);
        dispatch( new $job( $data ));
    }
}
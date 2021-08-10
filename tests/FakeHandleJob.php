<?php
namespace Artisanpay\Tests;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FakeHandleJob  implements ShouldQueue{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
}

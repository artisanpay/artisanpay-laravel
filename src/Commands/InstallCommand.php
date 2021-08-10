<?php
namespace Artisanpay\Commands;

use Artisanpay\ArtisanpayServiceProvider;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'artisanpay:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install artisanpay';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->comment('Publishing Artisanpay Configuration...');
        $this->callSilent('vendor:publish', ['--tag' => 'artisanpay-config']);
        return 0;
    }
}
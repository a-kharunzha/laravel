<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\SocketCounter;

class DoIncrementSocket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'socket:increment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'increments socket counter +1';

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
     * @return mixed
     */
    public function handle()
    {
		$counter = SocketCounter::getInstance();
		$newValue = $counter->increment();
    }
}

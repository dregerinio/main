<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\MainController;

class runLoop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'loop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $c = new MainController();
        echo 'loop ';
        $c->loop();
    }
}

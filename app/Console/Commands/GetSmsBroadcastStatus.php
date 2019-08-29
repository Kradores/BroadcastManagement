<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetSmsBroadcastStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exec:curlsmpp {link}';

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
     * @return mixed
     */
    public function handle()
    {
        $smpp = $this->argument('link');
        exec("echo 'smpp $smpp'", $result);
        $this->line($result[0]);
    }
}

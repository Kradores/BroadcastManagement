<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendTestSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exec:testsms {msisdn}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Execute script that sends one sms to specified test msisdn';

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
        $msisdn = $this->argument('msisdn');
        exec("echo 'hello $msisdn'", $result);
        echo json_encode($result);
    }
}

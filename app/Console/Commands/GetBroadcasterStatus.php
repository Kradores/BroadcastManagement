<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetBroadcasterStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exec:status';

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
        // ps aux | grep /SCRIPTS/USSD_DATING/awcc_af/crontab_scripts/broadcast.php | grep -v grep | grep -v '/bin/sh -c' | awk '{print "{\"start\":\"" $9"\",","\"duration\":\"" $10"\"}"}'
        exec('echo {"start":"11:00" , "duration":"1:09"}', $result);
        $this->line($result[0]);
    }
}

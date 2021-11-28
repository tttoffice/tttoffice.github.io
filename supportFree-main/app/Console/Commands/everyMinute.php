<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;



use DB;
use App\Models\Invoice;

class everyMinute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this will clean a db table ';

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

       // app('App\Http\Controllers\Background\GenerateInvoice')->InvoicePerDay();
        return 0;
    }
}

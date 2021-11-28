<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InvoicePerDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'every kitchen will have an invoice for App per day';

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
        app('App\Http\Controllers\Background\GenerateInvoice')->InvoicePerDay();
        return 0;
    }
}

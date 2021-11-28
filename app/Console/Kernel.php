<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use DB;
use App\Models\Invoice;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [

      //  Commands\everyMinute::class,
        Commands\InvoicePerDay::class,
        Commands\InvoicePerMonth::class,
        Commands\InvoicePerWeek::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /* $schedule->command('minute:update')
               ->everyMinute();*/

        $schedule->command('invoice:day')
               ->everyMinute();

        $schedule->command('invoice:week')
               ->everyMinute();

        $schedule->command('invoice:month')
               ->everyMinute();


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }


}

<?php

namespace App\Console;

use App\Models\Absensi;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\DailyQuote::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('minute:update')
                 ->everyMinute();
        // $schedule->call(function () {
        //     date_default_timezone_set("Asia/Jakarta");
        //     DB::table('absensi')->where('created_at', '<=', Carbon::now('Asia/Jakarta')->subMinutes(60)->toDateTimeString())
        //     ->update(
        //         [
        //             'status'=> 0
        //         ]
        //     );
        // })->everyMinute();
    }
    protected function scheduleTimezone()
    {
        return 'Asia/Jakarta';
    }
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}

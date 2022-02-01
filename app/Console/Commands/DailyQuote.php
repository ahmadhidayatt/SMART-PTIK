<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DailyQuote extends Command
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
    protected $description = 'Update Absensi Hourly';

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
        \Log::info("Cron is working fine!");
        date_default_timezone_set("Asia/Jakarta");
            DB::table('absensi')->where('created_at', '<=', Carbon::now('Asia/Jakarta')->subMinutes(60)->toDateTimeString())
            ->update(
                [
                    'status'=> 0
                ]
            );
        return 'Hourly Update has been send successfully';
    }
}

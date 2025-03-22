<?php

namespace App\Console;

use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Delete unverified users every 5 minutes
        $schedule->call(function () {
            DB::table('users')
                ->whereNull('email_verified_at') // User is not verified
                ->where('email_verification_sent_at', '<', Carbon::now()->subMinutes(5)) // Sent over 5 min ago
                ->delete();
        })->everyFiveMinutes();

        // Delete expired password reset tokens every 5 minutes
        $schedule->call(function () {
            DB::table('password_resets')
                ->where('created_at', '<', Carbon::now()->subMinutes(5))
                ->delete();
        })->everyFiveMinutes();
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

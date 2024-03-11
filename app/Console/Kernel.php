<?php

namespace App\Console;

use App\Mail\NewJobsNewsletter;
use App\Models\Job;
use App\Models\Newsletter;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            Job::where('status', 'active')
                ->where('application_deadline', '=', now('Europe/Belgrade')->format('Y-m-d'))
                ->update(['status' => Job::STATUS_EXPIRED]);
        })->dailyAt('00:00')->timezone('Europe/Belgrade');
        $schedule->call(function () {
           $jobs = Job::where('status', 'active')->latest('id')->limit(5)->get();
           $subscribers = Newsletter::all();
            foreach ($subscribers as $subscriber) {
                Mail::to($subscriber->email)->send(new NewJobsNewsletter($subscriber->email,$jobs));
            }
        })->dailyAt('18:00')->timezone('Europe/Belgrade');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

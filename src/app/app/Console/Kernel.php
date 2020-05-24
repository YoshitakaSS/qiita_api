<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\InsertAuthorsCommands::class,
        \App\Console\Commands\InsertTagsCommands::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /**
         * バッチスケジュール
         *
         * スケジュール登録方法(下記でcrontabに登録する)
         * * * * * * cd /var/www/qiita | php artisan schedule:run >> /var/log/cron.log 2>&1
         */
        $schedule->command('insertAuthors')->cron('* 11 * * *');
        $schedule->command('insertTags')->cron('* 11 * * *');
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

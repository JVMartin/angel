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
		// Used in development:
		\App\Console\Commands\FlushApplication::class,
		\App\Console\Commands\RebuildDatabase::class,
		\App\Console\Commands\RebuildTestingDatabase::class,

		// Used in production:
		//\App\Console\Commands\DeleteUnverifiedUsers::class,
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		// $schedule->command('inspire')
		//          ->hourly();
	}

	/**
	 * Register the Closure based commands for the application.
	 *
	 * @return void
	 */
	protected function commands()
	{
		require base_path('routes/console.php');
	}
}

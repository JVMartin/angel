<?php

namespace App\Console\Commands;

use Schema;
use Illuminate\Console\Command;

class RebuildDatabase extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'db:rebuild';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Rebuild the database.';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$this->info('Rebuilding database...');
		if (Schema::hasTable('migrations')) {
			$this->call('migrate:reset');
		}
		$this->call('migrate');
		$this->call('db:seed');
	}
}

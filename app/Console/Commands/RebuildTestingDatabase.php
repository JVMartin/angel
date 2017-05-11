<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RebuildTestingDatabase extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'testing:rebuild';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Rebuild the testing database.';

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		// First check that we are using sqlite as the testing database
		$connection = $this->prepareDatabaseConnection();

		// Confirm DB file exists
		$this->prepareSQLiteFile($connection);

		// Run the database migrations
		$this->call('migrate', ['--database' => 'testing']);

		// Run the DatabaseSeeder
		$this->call('db:seed', ['--database' => 'testing']);

		// Overwrite the "prepared" file with the newly seeded database.
		copy(database_path('database.sqlite'), database_path('prepared.sqlite'));

		// Send a completion message to the user
		$this->info($connection['database'] . ' has been rebuilt.');
	}

	/**
	 * Before we do anything, verify that we have usable testing db credentials
	 *
	 * @return array
	 */
	public function prepareDatabaseConnection()
	{
		// Fetch the testing database connection data from config
		$connection = config('database.connections.testing', []);

		// Does the connection exist?
		if (empty($connection) || ! array_key_exists('database', $connection)) {
			$this->error('SQLite DB connection "testing" not found in config.');
			exit();
		}

		// Make sure the connection is meant to use sqlite
		if ($connection['driver'] != 'sqlite') {
			$this->error('This command is not intended to be used on a non-sqlite database.');
			exit();
		}

		return $connection;
	}

	/**
	 * Remove the existing database file and create a new one
	 *
	 * @param  array $connection
	 * @return void
	 */
	public function prepareSQLiteFile($connection)
	{
		// First remove the old database file
		if (file_exists($connection['database'])) {
			unlink($connection['database']);
		}

		// Now create an empty target database file
		touch($connection['database']);

		// Double check that the file exists before moving on
		if ( ! file_exists($connection['database'])) {
			$this->error("Could not create database file {$connection['database']}");
			exit();
		}
	}
}

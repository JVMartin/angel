<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call(UsersTableSeeder::class);
	}
}

class UsersTableSeeder extends Seeder
{
	public function run()
	{
		User::create([
			'role' => 'admin',
			'email' => 'admin@test',
			'password' => bcrypt('test')
		]);

		User::create([
			'email' => 'user@test',
			'password' => bcrypt('test')
		]);
	}
}
<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

use App\Models\User;
use App\Models\Page;
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
		$this->call(PagesTableSeeder::class);
	}
}

class UsersTableSeeder extends Seeder
{
	public function run()
	{
		User::create([
			'role' => 'admin',
			'email' => 'admin@test.com',
			'password' => bcrypt('test')
		]);

		User::create([
			'email' => 'user@test.com',
			'password' => bcrypt('test')
		]);
	}
}

class PagesTableSeeder extends Seeder
{
	public function run()
	{
		Page::create([
			'slug' => 'home',
			'title' => 'Home Page',
			'html' => '
				<h1>Your Home Page</h1>
				<p>Hello there.</p>
			',
		]);
	}
}
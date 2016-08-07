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
			'first_name' => 'Test',
			'last_name' => 'Admin',
			'password' => bcrypt('test')
		]);

		User::create([
			'email' => 'user@test.com',
			'first_name' => 'Test',
			'last_name' => 'User',
			'password' => bcrypt('test')
		]);

		factory(User::class, 'user')->times(250)->create();
		factory(User::class, 'admin')->times(6)->create();
	}
}

class PagesTableSeeder extends Seeder
{
	public function run()
	{
		Page::create([
			'slug' => 'home',
			'title' => 'Angel CMS',
			'html' => '
				<h3>Custom Content</h3>
				<p>
					The content in this column is customizable.  Sign in to the <a href="/admin">
					admin panel</a> to customize it!  Here, have some lorem:
				</p>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
			',
		]);

		Page::create([
			'slug' => 'about',
			'title' => 'About',
			'html' => '
				<h1>About Page</h1>
				<p>Here is some stuff about our company.</p>
			',
		]);

		Page::create([
			'slug' => 'contact-us',
			'title' => 'Contact Us',
			'html' => '
				<h1>Contact Us Page</h1>
				<p>We hope to hear from you soon!</p>
			',
		]);
	}
}
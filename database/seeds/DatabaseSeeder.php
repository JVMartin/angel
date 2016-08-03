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
			'title' => 'Angel CMS',
			'html' => '
				<h1>Angel CMS Default Home Page</h1>
				<p>Hello there.</p>
				<p><a href="/admin">Sign into admin panel...</a></p>
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
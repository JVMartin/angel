<?php

use App\User;
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
	}
}
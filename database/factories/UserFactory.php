<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

use App\Models\User;

$factory->defineAs(User::class, 'user', function (Faker\Generator $faker) {
	return [
		'role' => 'user',
		'first_name' => $faker->firstName,
		'last_name' => $faker->lastName,
		'email' => $faker->safeEmail,
		'password' => bcrypt(str_random(10)),
		'remember_token' => str_random(10),
	];
});

$factory->defineAs(User::class, 'admin', function (Faker\Generator $faker) use ($factory) {
	return $factory->raw(User::class, [
		'role' => 'admin'
	], 'user');
});

$factory->defineAs(User::class, 'superadmin', function (Faker\Generator $faker) use ($factory) {
	return $factory->raw(User::class, [
		'role' => 'superadmin'
	], 'user');
});

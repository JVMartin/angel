<?php

$factory->defineAs(App\Models\User::class, 'user', function (Faker\Generator $faker) {
	return [
		'role' => 'user',
		'name' => $faker->name,
		'email' => $faker->safeEmail,
		'password' => bcrypt(str_random(10)),
		'remember_token' => str_random(10),
	];
});

$factory->defineAs(App\Models\User::class, 'admin', function (Faker\Generator $faker) use ($factory) {
	return $factory->raw(App\Models\User::class, [
		'role' => 'admin'
	], 'user');
});

$factory->defineAs(App\Models\User::class, 'superadmin', function (Faker\Generator $faker) use ($factory) {
	return $factory->raw(App\Models\User::class, [
		'role' => 'superadmin'
	], 'user');
});

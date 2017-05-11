<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('role')->default('user');
			$table->string('email')->unique();
			$table->string('first_name');
			$table->string('last_name');
			$table->string('password')->nullable();
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}
}

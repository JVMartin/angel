<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('password_resets', function (Blueprint $table) {
			$table->string('email')->index();
			$table->string('token')->index();
			$table->timestamp('created_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('password_resets');
	}
}

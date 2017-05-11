<?php
/**
 * @copyright (c) 2016 Jacob Martin
 * @license MIT https://opensource.org/licenses/MIT
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChangesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('changes', function (Blueprint $table) {
			$table->increments('id');
			$table->string('loggable_type');
			$table->integer('loggable_id')->unsigned();
			$table->string('column');
			$table->text('content');
			$table->integer('user_id')->unsigned();
			$table->timestamp('created_at');

			// Do not cascade deletes here; however, they will need to be handled in some way.
			$table->foreign('user_id')
				->references('id')->on('users');

			$table->index(['loggable_type', 'loggable_id', 'column']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('changes');
	}
}

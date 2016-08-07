<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function (Blueprint $table) {
			$table->increments('id');
			$table->string('slug')->unique();
			$table->string('title');
			$table->string('image');
			$table->string('og_desc', 300);
			$table->text('html');
			$table->text('plaintext');
			$table->timestamps();
		});

		DB::statement('
			ALTER TABLE `pages` ADD FULLTEXT search(
				`title`,
				`plaintext`
		)');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('SET foreign_key_checks = 0');
		Schema::drop('pages');
		DB::statement('SET foreign_key_checks = 1');
	}
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blogs', function (Blueprint $table) {
			$table->increments('id');
			$table->string('slug')->unique()->nullable();
			$table->string('title')->nullable();
			$table->string('image')->nullable();
			$table->string('og_desc', 300)->nullable();
			$table->text('html')->nullable();
			$table->text('plaintext')->nullable();
			$table->boolean('visible')->default(false);
			$table->integer('author_id')->unsigned();
			$table->timestamp('published_at')->nullable();
			$table->timestamps();

			$table->foreign('author_id')
				->references('id')->on('users')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('blogs');
	}
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobBoardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('job_boards', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 200)->nullable();
			$table->integer('avi')->nullable();
			$table->string('url', 200)->nullable();
			$table->string('img', 200)->nullable();
			$table->string('type', 100)->nullable();
			$table->float('price', 10, 0)->nullable();
			$table->text('about', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('job_boards');
	}

}

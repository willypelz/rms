<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobsJobBoardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jobs_job_boards', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('job_id')->nullable();
			$table->integer('job_board_id')->nullable();
			$table->text('url', 65535)->nullable();
			$table->dateTime('date_added')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('jobs_job_boards');
	}

}

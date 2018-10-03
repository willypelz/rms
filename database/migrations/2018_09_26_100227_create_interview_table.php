<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInterviewTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('interview', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('job_application_id')->nullable();
			$table->string('location', 300);
			$table->dateTime('date')->nullable();
			$table->text('message', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('interview');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobApplicationMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('job_application_messages', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('job_application_id')->nullable();
			$table->integer('sender_user_id');
			$table->string('title');
			$table->text('message', 65535);
			$table->boolean('from_employer')->default(0);
			$table->boolean('read')->default(0);
			$table->dateTime('read_date')->nullable();
			$table->string('attachment')->nullable();
			$table->boolean('deleted');
			$table->dateTime('created');
			$table->dateTime('modified')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('job_application_messages');
	}

}

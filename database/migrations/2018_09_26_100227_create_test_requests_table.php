<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTestRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('test_requests', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('job_application_id');
			$table->integer('test_id');
			$table->string('test_name')->nullable();
			$table->string('test_owner')->nullable();
			$table->dateTime('start_time');
			$table->integer('order_id')->nullable();
			$table->dateTime('end_time');
			$table->text('location', 65535)->nullable();
			$table->dateTime('actual_start_time')->nullable();
			$table->dateTime('actual_end_time')->nullable();
			$table->float('score')->nullable()->default(0.00);
			$table->text('result_comment', 65535)->nullable();
			$table->string('status')->default('PENDING');
			$table->integer('credit');
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
		Schema::drop('test_requests');
	}

}

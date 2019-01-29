<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAtsRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ats_requests', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('ats_product_id')->nullable();
			$table->integer('job_application_id')->nullable();
			$table->integer('job_id')->nullable();
			$table->string('service_type', 100)->nullable();
			$table->float('cost', 10, 0)->nullable();
			$table->float('discount', 10, 0)->nullable();
			$table->string('status', 100)->nullable()->default('PENDING');
			$table->text('notes', 65535)->nullable();
			$table->text('final_report', 65535)->nullable();
			$table->text('attachments', 65535)->nullable();
			$table->dateTime('created')->nullable();
			$table->dateTime('modified')->nullable();
			$table->integer('order_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ats_requests');
	}

}

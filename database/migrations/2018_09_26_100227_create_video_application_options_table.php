<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVideoApplicationOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('video_application_options', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 256)->nullable();
			$table->string('type', 128)->nullable();
			$table->text('options', 65535)->nullable();
			$table->integer('job_id')->nullable()->index('job_id');
			$table->timestamps();
			$table->text('correct_option', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('video_application_options');
	}

}

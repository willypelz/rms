<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobActivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('job_activities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->nullable()->index();
			$table->integer('job_application_id')->unsigned()->nullable()->index('job_activities_cv_id_index');
			$table->integer('job_id')->unsigned()->nullable()->index();
			$table->text('comment', 65535)->nullable();
			$table->string('activity_type');
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
		Schema::drop('job_activities');
	}

}

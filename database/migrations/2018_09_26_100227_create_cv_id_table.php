<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCvIdTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cv_id', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->integer('job_id');
			$table->text('cover_note', 65535);
			$table->boolean('sent_to_employer');
			$table->string('status', 100)->default('pending')->comment('pending, shorlisted, interviewed, rejected, hired, assessment');
			$table->integer('hiring_progress_id')->default(1);
			$table->integer('interview_id')->nullable();
			$table->text('shortlist_note', 65535);
			$table->dateTime('created');
			$table->dateTime('action_date')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cv_id');
	}

}

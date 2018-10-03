<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInterviewNotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('interview_notes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('job_application_id')->nullable();
			$table->integer('interviewer_id')->nullable();
			$table->integer('general_appearance')->nullable();
			$table->integer('educational_background')->nullable();
			$table->integer('prior_work_experience')->nullable();
			$table->integer('professional_qualifications')->nullable();
			$table->integer('verbal_communication')->nullable();
			$table->integer('candidate_enthusiasm')->nullable();
			$table->integer('relevant_experience')->nullable();
			$table->integer('career_progression')->nullable();
			$table->integer('initiative')->nullable();
			$table->integer('time_management')->nullable();
			$table->integer('customer_service_orientation')->nullable();
			$table->integer('technology_enablement')->nullable();
			$table->integer('brand_projection')->nullable();
			$table->integer('intellectual_capacity')->nullable();
			$table->integer('reasoning')->nullable();
			$table->integer('general_knowledge')->nullable();
			$table->integer('knowledge_of_industry')->nullable();
			$table->integer('quantitative_capacity')->nullable();
			$table->integer('attitude_to_issues')->nullable();
			$table->integer('predesposition_to_training')->nullable();
			$table->text('learning_skills', 65535)->nullable();
			$table->text('verbal_skills', 65535)->nullable();
			$table->text('career_focus', 65535)->nullable();
			$table->integer('availability')->nullable();
			$table->text('general_comments', 65535)->nullable();
			$table->string('recommendation', 100)->nullable();
			$table->dateTime('interview_date')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('interview_notes');
	}

}

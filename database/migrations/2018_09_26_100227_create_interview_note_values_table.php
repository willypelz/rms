<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInterviewNoteValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('interview_note_values', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('interview_note_option_id')->nullable()->index('form_field_id');
			$table->text('value', 65535)->nullable();
			$table->integer('job_application_id')->nullable()->index('jobapplicationid');
			$table->timestamps();
			$table->integer('interviewed_by')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('interview_note_values');
	}

}

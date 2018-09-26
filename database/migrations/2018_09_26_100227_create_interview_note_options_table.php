<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInterviewNoteOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('interview_note_options', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('header', 65535)->nullable();
			$table->string('name', 256)->nullable();
			$table->text('description', 65535)->nullable();
			$table->string('type', 128)->nullable();
			$table->text('options', 65535)->nullable();
			$table->integer('weight')->nullable();
			$table->integer('job_id')->nullable()->index('job_id');
			$table->integer('company_id')->nullable();
			$table->timestamps();
			$table->text('correct_option', 65535)->nullable();
			$table->integer('interview_template_id')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('interview_note_options');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInterviewNoteTemplatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('interview_note_templates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 128)->nullable();
			$table->text('description', 65535)->nullable();
			$table->integer('company_id')->nullable();
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
		Schema::drop('interview_note_templates');
	}

}
